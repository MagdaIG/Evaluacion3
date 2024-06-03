<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MantenimientoInfoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/mantenimiento_info",
     *     summary="Obtener toda la información de mantenimiento",
     *     operationId="getAllMantenimientoInfo",
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
        // Obtener toda la información de mantenimiento de la base de datos
        $data = DB::select('SELECT id, nombre, texto, activo FROM mantenimiento_info');

        // Verifica si el array de resultados está vacío
        if (empty($data)) {
            return response()->json(['message' => 'No se encontraron datos'], Response::HTTP_NOT_FOUND);
        }

        // Retorna los datos encontrados si existen
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/v1/mantenimiento_info/{id}",
     *     summary="Obtener información de mantenimiento por ID",
     *     operationId="getMantenimientoInfoById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de mantenimiento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        // Obtener información de mantenimiento por ID de la base de datos
        $data = DB::select('SELECT id, nombre, texto, activo FROM mantenimiento_info WHERE id = ?', [$id]);

        // Verifica si se encontró algún registro
        if (empty($data)) {
            return response()->json(['message' => 'Recurso no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Si se encuentra el registro, retorna el mismo
        return response()->json($data[0], Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/v1/mantenimiento_info",
     *     summary="Agregar nueva información de mantenimiento",
     *     operationId="addMantenimientoInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "texto", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de mantenimiento creada con éxito"
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
            $validatedData = $request->validate([
                'nombre' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Realizar la inserción en la base de datos
            $id = DB::table('mantenimiento_info')->insertGetId([
                'nombre' => $validatedData['nombre'],
                'texto' => $validatedData['texto'],
                'activo' => $validatedData['activo'],
            ]);

            // Retorna un objeto con un mensaje de éxito y el id del registro insertado.
            return response()->json(['message' => 'Información de mantenimiento agregada con éxito', 'id' => $id], Response::HTTP_CREATED);
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
     *     path="/v1/mantenimiento_info/{id}",
     *     summary="Actualizar o crear información de mantenimiento por ID",
     *     operationId="updateMantenimientoInfo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de mantenimiento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "texto", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de mantenimiento actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de mantenimiento creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'nombre' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Intenta realizar la actualización en la base de datos
            $updateResult = DB::update(
                'UPDATE mantenimiento_info SET nombre = ?, texto = ?, activo = ? WHERE id = ?',
                [$request->nombre, $request->texto, $request->activo, $id]
            );

            if ($updateResult === 0) {
                // Si no existieron filas actualizadas, intenta crear el registro porque PUT es idempotente
                $id = DB::table('mantenimiento_info')->insertGetId([
                    'id' => $id,
                    'nombre' => $request->nombre,
                    'texto' => $request->texto,
                    'activo' => $request->activo,
                ]);

                // Retornamos 201 que es CREATED ya que tuvimos que crear
                return response()->json(['message' => 'Información de mantenimiento creada con éxito', 'id' => $id], Response::HTTP_CREATED);
            }

            // Retorna un objeto con un mensaje de éxito si la actualización fue exitosa
            return response()->json(['message' => 'Información de mantenimiento actualizada con éxito', 'id' => $id], Response::HTTP_OK);
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
     *     path="/v1/mantenimiento_info/{id}",
     *     summary="Eliminar información de mantenimiento por ID",
     *     operationId="deleteMantenimientoInfo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de mantenimiento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de mantenimiento eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Intentar eliminar la información de mantenimiento por ID
        $deleteResult = DB::delete('DELETE FROM mantenimiento_info WHERE id = ?', [$id]);

        // Verifica si se eliminó alguna fila
        if ($deleteResult === 0) {
            return response()->json(['message' =>

                'No se encontró el id'], Response::HTTP_NOT_FOUND);
        }

        // Retorna una respuesta exitosa
        return response()->json(['message' => 'Información de mantenimiento eliminada con éxito'], Response::HTTP_OK);
    }

    /**
     * @OA\Patch(
     *     path="/v1/mantenimiento_info/{id}",
     *     summary="Actualizar parcialmente información de mantenimiento por ID",
     *     operationId="partialUpdateMantenimientoInfo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de mantenimiento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de mantenimiento actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No hay datos para actualizar"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        // Construir la consulta de actualización dinámicamente para los campos de la información de mantenimiento
        $cambiosAplicar = [];
        if ($request->has('nombre')) {
            $cambiosAplicar['nombre'] = $request->nombre;
        }
        if ($request->has('texto')) {
            $cambiosAplicar['texto'] = $request->texto;
        }
        if ($request->has('activo')) {
            $cambiosAplicar['activo'] = $request->activo;
        }

        // Verificar si hay cambios para aplicar
        if (empty($cambiosAplicar)) {
            return response()->json(['message' => 'No hay datos para actualizar'], Response::HTTP_BAD_REQUEST);
        }

        try {
            // Intentar actualizar la información de mantenimiento
            $resultado = DB::table('mantenimiento_info')
                ->where('id', $id)
                ->update($cambiosAplicar);

            // Verificar si se actualizó alguna fila
            if ($resultado === 0) {
                return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
            }

            // Retorna una respuesta exitosa
            return response()->json(['message' => 'Información de mantenimiento actualizada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
