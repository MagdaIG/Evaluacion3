<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class HistoriaController extends Controller
{
    /**
     * Obtener imágenes asociadas con una historia
     *
     * @param string $historiaId
     * @return array
     */
    private function getImagen($historiaId)
    {
        $data = DB::select(
            'SELECT id, nombre, imagen, activo FROM imagen WHERE id IN (SELECT imagen_id FROM historia_imagen WHERE historia_id = ?)',
            [$historiaId]
        );
        return $data;
    }

    /**
     * @OA\Get(
     *     path="/v1/historia",
     *     summary="Obtener todas las historias",
     *     operationId="getAllHistorias",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     )
     * )
     */
    public function index()
    {
        // Obtener todas las historias de la base de datos
        $data = DB::select('SELECT id, tipo, texto, activo FROM historia');
        // Para cada historia, obtener sus imágenes asociadas
        foreach ($data as &$historia) {
            $historia->imagenes = $this->getImagen($historia->id);
        }
        // Devolver las historias con sus imágenes asociadas
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/v1/historia/{id}",
     *     summary="Obtener una historia por ID",
     *     operationId="getHistoriaById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la historia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Historia no encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al recuperar la historia"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            // Obtener la historia por ID
            $data = DB::select('SELECT id, tipo, texto, activo FROM historia WHERE id = ?', [$id]);

            // Verifica si la consulta no retorna resultados
            if (empty($data)) {
                return response()->json(['message' => 'Historia no encontrada'], Response::HTTP_NOT_FOUND);
            }

            // Obtener imágenes asociadas
            $imagenes = $this->getImagen($id);
            $historia = $data[0];
            $historia->imagenes = $imagenes;

            return response()->json($historia, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al recuperar la historia: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/v1/historia",
     *     summary="Agregar una nueva historia",
     *     operationId="addHistoria",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo", "texto", "activo", "imagenes"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(
     *                 property="imagenes",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"nombre", "imagen", "activo"},
     *                     @OA\Property(property="nombre", type="string"),
     *                     @OA\Property(property="imagen", type="string"),
     *                     @OA\Property(property="activo", type="boolean")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Historia creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validación fallida"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al agregar la historia"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {

            // Validar los datos de entrada
            $request->validate([
                'tipo' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
                'imagenes' => 'required|array'
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Insertar una nueva historia en la base de datos
            $historiaId = DB::table('historia')->insertGetId([
                'tipo' => $request->tipo,
                'texto' => $request->texto,
                'activo' => $request->activo,
            ]);

            // Insertar imágenes y asociarlas con la historia
            foreach ($request->imagenes as $imagen) {
                $imagenId = DB::table('imagen')->insertGetId([
                    'nombre' => $imagen['nombre'],
                    'imagen' => $imagen['imagen'],
                    'activo' => $imagen['activo'],
                ]);

                DB::table('historia_imagen')->insert([
                    'historia_id' => $historiaId,
                    'imagen_id' => $imagenId,
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Información de historia agregada con éxito', 'id' => $historiaId], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            DB::rollBack();
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() === '23000') { // Código SQLSTATE para entrada duplicada
                return response()->json(['message' => 'El registro ya existe con los datos proporcionados.'], Response::HTTP_CONFLICT);
            } else {
                return response()->json(['message' => 'Error al procesar la solicitud debido a un error interno del servidor.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/historia/{id}",
     *     summary="Actualizar o crear una historia",
     *     operationId="updateHistoria",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la historia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo", "texto", "activo", "imagenes"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(
     *                 property="imagenes",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"nombre", "imagen", "activo"},
     *                     @OA\Property(property="nombre", type="string"),
     *                     @OA\Property(property="imagen", type="string"),
     *                     @OA\Property(property="activo", type="boolean")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Historia actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Historia creada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Historia no encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar o crear la historia"
     *     )
     * )
     */
    public function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'tipo' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
                'imagenes' => 'required|array'
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Verificar si la historia existe
            $historiaExistente = DB::select('SELECT id FROM historia WHERE id = ?', [$id]);

            if (empty($historiaExistente)) {
                return response()->json(['message' => 'Historia no encontrada'], Response::HTTP_NOT_FOUND);
            }

            // Actualizar la historia
            DB::update('UPDATE historia SET tipo = ?, texto = ?, activo = ? WHERE id = ?', [
                $request->tipo, $request->texto, $request->activo, $id
            ]);

            // Obtener IDs de imágenes existentes asociadas con la historia
            $imagenIdsExistentes = DB::select('SELECT imagen_id FROM historia_imagen WHERE historia_id = ?', [$id]);

            // Eliminar imágenes existentes
            if (!empty($imagenIdsExistentes)) {
                $imagenIds = array_map(function($row) {
                    return $row->imagen_id;
                }, $imagenIdsExistentes);

                DB::delete('DELETE FROM historia_imagen WHERE historia_id = ?', [$id]);
                DB::delete('DELETE FROM imagen WHERE id IN (' . implode(',', $imagenIds) . ')');
            }

            // Insertar nuevas imágenes y asociarlas con la historia
            foreach ($request->imagenes as $imagen) {
                $imagenId = DB::table('imagen')->insertGetId([
                    'nombre' => $imagen['nombre'],
                    'imagen' => $imagen['imagen'],
                    'activo' => $imagen['activo'],
                ]);

                DB::table('historia_imagen')->insert([
                    'historia_id' => $id,
                    'imagen_id' => $imagenId,
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Historia actualizada con éxito', 'id' => $id], Response::HTTP_OK);
        } catch (ValidationException $e) {
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar la historia: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/v1/historia/{id}",
     *     summary="Actualizar parcialmente una historia",
     *     operationId="partialUpdateHistoria",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la historia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(
     *                 property="imagenes",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="nombre", type="string"),
     *                     @OA\Property(property="imagen", type="string"),
     *                     @OA\Property(property="activo", type="boolean")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Historia actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Historia no encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la historia"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        // Verificar si la historia existe
        $historiaExistente = DB::select('SELECT id FROM historia WHERE id = ?', [$id]);

        if (empty($historiaExistente)) {
            return response()->json(['message' => 'Historia no encontrada'], Response::HTTP_NOT_FOUND);
        }

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Construir la consulta de actualización dinámicamente para los campos de la historia
            $updateFields = [];
            $queryParams = [];

            if ($request->has('tipo')) {
                $updateFields[] = 'tipo = ?';
                $queryParams[] = $request->tipo;
            }
            if ($request->has('texto')) {
                $updateFields[] = 'texto = ?';
                $queryParams[] = $request->texto;
            }
            if ($request->has('activo')) {
                $updateFields[] = 'activo = ?';
                $queryParams[] = $request->activo;
            }

            // Verificar si hay campos para actualizar
            if (!empty($updateFields)) {
                $queryParams[] = $id; // Añadir el ID al final para la cláusula WHERE
                $updateQuery = 'UPDATE historia SET ' . implode(', ', $updateFields) . ' WHERE id = ?';
                DB::update($updateQuery, $queryParams);
            }

            // Procesar las nuevas imágenes si se proporcionan
            if ($request->has('imagenes')) {
                foreach ($request->imagenes as $imagen) {
                    $imagenId = DB::table('imagen')->insertGetId([
                        'nombre' => $imagen['nombre'],
                        'imagen' => $imagen['imagen'],
                        'activo' => $imagen['activo'],
                    ]);

                    DB::table('historia_imagen')->insert([
                        'historia_id' => $id,
                        'imagen_id' => $imagenId,
                    ]);
                }
            }

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Historia actualizada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar la historia: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/historia/{id}",
     *     summary="Eliminar una historia por ID",
     *     operationId="deleteHistoria",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la historia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Historia eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Historia no encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar la historia"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Verificar si la historia existe
        $historiaExistente = DB::select('SELECT id FROM historia WHERE id = ?', [$id]);

        if (empty($historiaExistente)) {
            return response()->json(['message' => 'Historia no encontrada'], Response::HTTP_NOT_FOUND);
        }

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener IDs de imágenes existentes asociadas con la historia
            $imagenIdsExistentes = DB::select('SELECT imagen_id FROM historia_imagen WHERE historia_id = ?', [$id]);

            // Eliminar relaciones historia-imagen
            DB::delete('DELETE FROM historia_imagen WHERE historia_id = ?', [$id]);

            // Eliminar imágenes asociadas
            if (!empty($imagenIdsExistentes)) {
                $imagenIds = array_map(function($row) {
                    return $row->imagen_id;
                }, $imagenIdsExistentes);

                DB::delete('DELETE FROM imagen WHERE id IN (' . implode(',', $imagenIds) . ')');
            }

            // Eliminar la historia
            DB::delete('DELETE FROM historia WHERE id = ?', [$id]);

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Información de historia eliminada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['message' => 'Error al eliminar la historia: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
