<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class InfoContactoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/info_contacto",
     *     summary="Obtener toda la información de contacto",
     *     operationId="getAllInfoContacto",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     )
     * )
     */
    public function index()
    {
        // Obtener toda la información de contacto de la base de datos
        $data = DB::select('SELECT id, nombre, texto, texto_adicional, activo FROM info_contacto');
        // Devolver los datos obtenidos en formato JSON
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/v1/info_contacto/{id}",
     *     summary="Obtener información de contacto por ID",
     *     operationId="getInfoContactoById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Información de contacto no encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        // Obtener información de contacto por ID de la base de datos
        $data = DB::select('SELECT id, nombre, texto, texto_adicional, activo FROM info_contacto WHERE id = ?', [$id]);

        // Verifica si la consulta no retorna resultados
        if (empty($data)) {
            return response()->json(['message' => 'No se encontraron datos'], Response::HTTP_NOT_FOUND);
        }

        // Devolver los datos obtenidos en formato JSON
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/v1/info_contacto",
     *     summary="Agregar nueva información de contacto",
     *     operationId="addInfoContacto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "texto", "texto_adicional", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="texto_adicional", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de contacto creada con éxito"
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
                'nombre' => 'required|string',
                'texto' => 'required|string',
                'texto_adicional' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Realizar la inserción en la base de datos
            $id = DB::table('info_contacto')->insertGetId([
                'nombre' => $request->nombre,
                'texto' => $request->texto,
                'texto_adicional' => $request->texto_adicional,
                'activo' => $request->activo,
            ]);

            // Devolver una respuesta exitosa con el ID del nuevo registro
            return response()->json(['message' => 'Información de contacto creada con éxito', 'id' => $id], Response::HTTP_CREATED);
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
     *     path="/v1/info_contacto/{id}",
     *     summary="Actualizar o crear información de contacto por ID",
     *     operationId="updateInfoContacto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "texto", "texto_adicional", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="texto_adicional", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de contacto actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de contacto creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Información de contacto no encontrada"
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Validar los datos de entrada
            $request->validate([
                'nombre' => 'required|string',
                'texto' => 'required|string',
                'texto_adicional' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            // Intentar actualizar la información de contacto
            $updateResult = DB::update(
                'UPDATE info_contacto SET nombre = ?, texto = ?, texto_adicional = ?, activo = ? WHERE id = ?',
                [$request->nombre, $request->texto, $request->texto_adicional, $request->activo, $id]
            );

            // Si no se actualizó ninguna fila, crear una nueva información de contacto
            if ($updateResult === 0) {
                $id = DB::table('info_contacto')->insertGetId([
                    'id' => $id,
                    'nombre' => $request->nombre,
                    'texto' => $request->texto,
                    'texto_adicional' => $request->texto_adicional,
                    'activo' => $request->activo,
                ]);

                DB::commit();
                return response()->json(['message' => 'Información de contacto creada con éxito', 'id' => $id], Response::HTTP_CREATED);
            }

            // Confirmar la transacción
            DB::commit();

            // Devolver una respuesta exitosa
            return response()->json(['message' => 'Información de contacto actualizada con éxito', 'id' => $id], Response::HTTP_OK);
        } catch (ValidationException $e) {
            DB::rollBack();
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar la información de contacto: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/info_contacto/{id}",
     *     summary="Eliminar información de contacto por ID",
     *     operationId="deleteInfoContacto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de contacto eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Información de contacto no encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Intentar eliminar la información de contacto por ID
        $deleteResult = DB::delete('DELETE FROM info_contacto WHERE id = ?', [$id]);

        // Verificar si se eliminó alguna fila
        if ($deleteResult === 0)

        {
            return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
        }

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Información de contacto eliminada con éxito'], Response::HTTP_OK);
    }

    /**
     * @OA\Patch(
     *     path="/v1/info_contacto/{id}",
     *     summary="Actualizar parcialmente información de contacto por ID",
     *     operationId="partialUpdateInfoContacto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la información de contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="texto_adicional", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de contacto actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Información de contacto no encontrada"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        // Construir la consulta de actualización dinámicamente para los campos de la información de contacto
        $cambiosAplicar = [];
        if ($request->has('nombre')) {
            $cambiosAplicar['nombre'] = $request->nombre;
        }
        if ($request->has('texto')) {
            $cambiosAplicar['texto'] = $request->texto;
        }
        if ($request->has('texto_adicional')) {
            $cambiosAplicar['texto_adicional'] = $request->texto_adicional;
        }
        if ($request->has('activo')) {
            $cambiosAplicar['activo'] = $request->activo;
        }

        // Verificar si hay cambios para aplicar
        if (empty($cambiosAplicar)) {
            return response()->json(['message' => 'No hay datos para actualizar'], Response::HTTP_BAD_REQUEST);
        }

        // Intentar actualizar la información de contacto
        $resultado = DB::table('info_contacto')
            ->where('id', $id)
            ->update($cambiosAplicar);

        // Verificar si se actualizó alguna fila
        if ($resultado === 0) {
            return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
        }

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Información de contacto actualizada con éxito'], Response::HTTP_OK);
    }
}
