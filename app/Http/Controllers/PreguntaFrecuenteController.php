<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PreguntaFrecuenteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/pregunta_frecuente",
     *     summary="Obtener todas las preguntas frecuentes",
     *     operationId="getAllPreguntasFrecuentes",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron datos"
     *     )
     * )
     */
    public function index()
    {
        // Obtener todas las preguntas frecuentes de la base de datos
        $data = DB::select('SELECT id, pregunta, respuesta, activo FROM pregunta_frecuente');

        // Verifica si el array de resultados está vacío
        if (empty($data)) {
            return response()->json(['message' => 'No se encontraron datos'], Response::HTTP_NOT_FOUND);
        }

        // Retorna los datos encontrados si existen
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/v1/pregunta_frecuente/{id}",
     *     summary="Obtener una pregunta frecuente por ID",
     *     operationId="getPreguntaFrecuenteById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la pregunta frecuente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pregunta frecuente no existe"
     *     )
     * )
     */
    public function show($id)
    {
        // Obtener una pregunta frecuente por ID de la base de datos
        $data = DB::select('SELECT id, pregunta, respuesta, activo FROM pregunta_frecuente WHERE id = ?', [$id]);

        // Verifica si se encontró algún registro
        if (empty($data)) {
            return response()->json(['message' => 'Pregunta frecuente no existe'], Response::HTTP_NOT_FOUND);
        }

        // Si se encuentra el registro, retorna el mismo
        return response()->json($data[0], Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/v1/pregunta_frecuente",
     *     summary="Agregar nueva pregunta frecuente",
     *     operationId="createPreguntaFrecuente",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"pregunta", "respuesta", "activo"},
     *             @OA\Property(property="pregunta", type="string"),
     *             @OA\Property(property="respuesta", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pregunta frecuente creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validación fallida"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'pregunta' => 'required|string',
                'respuesta' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Realizar la inserción en la base de datos
            $id = DB::table('pregunta_frecuente')->insertGetId([
                'pregunta' => $request->pregunta,
                'respuesta' => $request->respuesta,
                'activo' => $request->activo,
            ]);

            // Retorna un objeto con un mensaje de éxito y el id del registro insertado.
            return response()->json(['message' => 'Información de pregunta frecuente agregada con éxito', 'id' => $id], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') { // Código SQLSTATE para entrada duplicada
                return response()->json(['message' => 'El registro ya existe con los datos proporcionados.'], Response::HTTP_CONFLICT);
            } else {
                return response()->json(['message' => 'Error al procesar la solicitud debido a un error interno del servidor.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/pregunta_frecuente/{id}",
     *     summary="Actualizar o crear una pregunta frecuente por ID",
     *     operationId="updatePreguntaFrecuente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la pregunta frecuente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"pregunta", "respuesta", "activo"},
     *             @OA\Property(property="pregunta", type="string"),
     *             @OA\Property(property="respuesta", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pregunta frecuente actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pregunta frecuente creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pregunta frecuente no encontrada"
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'pregunta' => 'required|string',
                'respuesta' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Intenta realizar la actualización en la base de datos
            $updateResult = DB::update(
                'UPDATE pregunta_frecuente SET pregunta = ?, respuesta = ?, activo = ? WHERE id = ?',
                [$request->pregunta, $request->respuesta, $request->activo, $id]
            );

            if ($updateResult === 0) {
                // Si no existieron filas actualizadas, intenta crear el registro porque PUT es idempotente
                $id = DB::table('pregunta_frecuente')->insertGetId([
                    'id' => $id,
                    'pregunta' => $request->pregunta,
                    'respuesta' => $request->respuesta,
                    'activo' => $request->activo,
                ]);

                // Retornamos 201 que es CREATED ya que tuvimos que crear
                return response()->json(['message' => 'Información de pregunta frecuente creada con éxito', 'id' => $id], Response::HTTP_CREATED);
            }

            // Retorna un objeto con un mensaje de éxito si la actualización fue exitosa
            return response()->json(['message' => 'Información de pregunta frecuente actualizada con éxito', 'id' => $id], Response::HTTP_OK);
        } catch (ValidationException $e) {
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') { // Código SQLSTATE para entrada duplicada
                return response()->json(['message' => 'Ya existe un registro con los datos proporcionados.'], Response::HTTP_CONFLICT);
            } else {
                return response()->json(['message' => 'Error al procesar la solicitud.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/pregunta_frecuente/{id}",
     *     summary="Eliminar una pregunta frecuente por ID",
     *     operationId="deletePreguntaFrecuente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la pregunta frecuente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pregunta frecuente eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pregunta frecuente no encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Intentar eliminar la pregunta frecuente por ID
        $deleteResult = DB::delete('DELETE FROM

 pregunta_frecuente WHERE id = ?', [$id]);

        // Verifica si se eliminó alguna fila
        if ($deleteResult === 0) {
            return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
        }

        // Retorna una respuesta exitosa
        return response()->json(['message' => 'Información de pregunta frecuente eliminada con éxito'], Response::HTTP_OK);
    }

    /**
     * @OA\Patch(
     *     path="/v1/pregunta_frecuente/{id}",
     *     summary="Actualizar parcialmente una pregunta frecuente por ID",
     *     operationId="partialUpdatePreguntaFrecuente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la pregunta frecuente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pregunta", type="string"),
     *             @OA\Property(property="respuesta", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pregunta frecuente actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pregunta frecuente no encontrada"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No hay datos para actualizar"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        // Construir la consulta de actualización dinámicamente para los campos de la pregunta frecuente
        $cambiosAplicar = [];
        if ($request->has('pregunta')) {
            $cambiosAplicar['pregunta'] = $request->pregunta;
        }
        if ($request->has('respuesta')) {
            $cambiosAplicar['respuesta'] = $request->respuesta;
        }
        if ($request->has('activo')) {
            $cambiosAplicar['activo'] = $request->activo;
        }

        // Verificar si hay cambios para aplicar
        if (empty($cambiosAplicar)) {
            return response()->json(['message' => 'No hay datos para actualizar'], Response::HTTP_BAD_REQUEST);
        }

        try {
            // Intentar actualizar la pregunta frecuente
            $resultado = DB::table('pregunta_frecuente')
                ->where('id', $id)
                ->update($cambiosAplicar);

            // Verificar si se actualizó alguna fila
            if ($resultado === 0) {
                return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
            }

            // Retorna una respuesta exitosa
            return response()->json(['message' => 'Información de pregunta frecuente actualizada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
