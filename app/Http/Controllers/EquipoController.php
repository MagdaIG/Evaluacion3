<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class EquipoController extends Controller
{
    /**
     * Obtener imágenes asociadas con un equipo
     *
     * @param string $equipoId
     * @return array
     */
    private function getImagen($equipoId)
    {
        $data = DB::select(
            'SELECT id, nombre, imagen, activo FROM imagen WHERE id IN (SELECT imagen_id FROM equipo_imagen WHERE equipo_id = ?)',
            [$equipoId]
        );
        return $data;
    }

    /**
     * @OA\Get(
     *     path="/v1/equipo/{id}",
     *     summary="Obtener un equipo por ID",
     *     operationId="getEquipoById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del equipo",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al recuperar el equipo"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $data = DB::select('SELECT id, tipo, texto, activo FROM equipo WHERE id = ?', [$id]);

            // Verifica si la consulta no retorna resultados
            if (empty($data)) {
                return response()->json(['message' => 'Equipo no encontrado'], Response::HTTP_NOT_FOUND);
            }

            // Obtener imágenes asociadas
            $imagenes = $this->getImagen($id);
            $equipo = $data[0];
            $equipo->imagenes = $imagenes;

            return response()->json($equipo, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al recuperar el equipo: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/equipo",
     *     summary="Obtener todos los equipos",
     *     operationId="getAllEquipos",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     )
     * )
     */
    public function index()
    {
        $data = DB::select('SELECT id, tipo, texto, activo FROM equipo');
        foreach ($data as &$equipo) {
            $equipo->imagenes = $this->getImagen($equipo->id);
        }
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/v1/equipo",
     *     summary="Agregar un nuevo equipo",
     *     operationId="addEquipo",
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
     *         description="Equipo creado con éxito"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validación fallida"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al agregar el equipo"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
                'imagenes' => 'required|array'
            ]);

            DB::beginTransaction();

            $equipoId = DB::table('equipo')->insertGetId([
                'tipo' => $request->tipo,
                'texto' => $request->texto,
                'activo' => $request->activo,
            ]);

            foreach ($request->imagenes as $imagen) {
                $imagenId = DB::table('imagen')->insertGetId([
                    'nombre' => $imagen['nombre'],
                    'imagen' => $imagen['imagen'],
                    'activo' => $imagen['activo'],
                ]);

                DB::table('equipo_imagen')->insert([
                    'imagen_id' => $imagenId,
                    'equipo_id' => $equipoId,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Información de equipo agregada con éxito', 'id' => $equipoId], Response::HTTP_CREATED);
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
     *     path="/v1/equipo/{id}",
     *     summary="Actualizar o crear un equipo",
     *     operationId="updateOrCreateEquipo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del equipo",
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
     *         description="Equipo actualizado con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Equipo creado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar o crear el equipo"
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        try {

            $request->validate([
                'tipo' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
                'imagenes' => 'required|array'
            ]);

            DB::beginTransaction();

            $equipoExistente = DB::select('SELECT id FROM equipo WHERE id = ?', [$id]);

            if (empty($equipoExistente)) {
                return response()->json(['message' => 'Equipo no encontrado'], Response::HTTP_NOT_FOUND);
            }

            DB::update('UPDATE equipo SET tipo = ?, texto = ?, activo = ? WHERE id = ?', [
                $request->tipo, $request->texto, $request->activo, $id
            ]);

            $imagenIdsExistentes = DB::select('SELECT imagen_id FROM equipo_imagen WHERE equipo_id = ?', [$id]);

            if (!empty($imagenIdsExistentes)) {
                $imagenIds = array_map(function($row) {
                    return $row->imagen_id;
                }, $imagenIdsExistentes);

                DB::delete('DELETE FROM equipo_imagen WHERE equipo_id = ?', [$id]);
                DB::delete('DELETE FROM imagen WHERE id IN (' . implode(',', $imagenIds) . ')');
            }

            foreach ($request->imagenes as $imagen) {
                $imagenId = DB::table('imagen')->insertGetId([
                    'nombre' => $imagen['nombre'],
                    'imagen' => $imagen['imagen'],
                    'activo' => $imagen['activo'],
                ]);

                DB::table('equipo_imagen')->insert([
                    'imagen_id' => $imagenId,
                    'equipo_id' => $id,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Equipo actualizado con éxito', 'id' => $id], Response::HTTP_OK);
        } catch (ValidationException $e) {
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar el equipo: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Patch(
     *     path="/v1/equipo/{id}",
     *     summary="Actualizar parcialmente un equipo",
     *     operationId="partialUpdateEquipo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del equipo",
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
     *         description="Equipo actualizado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar el equipo"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        $equipoExistente = DB::select('SELECT id FROM equipo WHERE id = ?', [$id]);

        if (empty($equipoExistente)) {
            return response()->json(['message' => 'Equipo no encontrado'], Response::HTTP_NOT_FOUND);
        }

        DB::beginTransaction();

        try {
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

            if (!empty($updateFields)) {
                $queryParams[] = $id;
                $updateQuery = 'UPDATE equipo SET ' . implode(', ', $updateFields) . ' WHERE id = ?';
                DB::update($updateQuery, $queryParams);
            }

            if ($request->has('imagenes')) {
                foreach ($request->imagenes as $imagen) {
                    $imagenId = DB::table('imagen')->insertGetId([
                        'nombre' => $imagen['nombre'],
                        'imagen' => $imagen['imagen'],
                        'activo' => $imagen['activo'],
                    ]);

                    DB::table('equipo_imagen')->insert([
                        'imagen_id' => $imagenId,
                        'equipo_id' => $id,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Equipo actualizado con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar el equipo: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/equipo/{id}",
     *     summary="Eliminar un equipo por ID",
     *     operationId="deleteEquipo",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del equipo",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Equipo eliminado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar el equipo"
     *     )
     * )
     */
    public function destroy($id)
    {
        $equipoExistente = DB::select('SELECT id FROM equipo WHERE id = ?', [$id]);

        if (empty($equipoExistente)) {
            return response()->json(['message' => 'Equipo no encontrado'], Response::HTTP_NOT_FOUND);
        }

        DB::beginTransaction();

        try {
            $imagenIdsExistentes = DB::select('SELECT imagen_id FROM equipo_imagen WHERE equipo_id = ?', [$id]);

            DB::delete('DELETE FROM equipo_imagen WHERE equipo_id = ?', [$id]);

            if (!empty($imagenIdsExistentes)) {
                $imagenIds = array_map(function($row) {
                    return $row->imagen_id;
                }, $imagenIdsExistentes);

                DB::delete('DELETE FROM imagen WHERE id IN (' . implode(',', $imagenIds) . ')');
            }

            DB::delete('DELETE FROM equipo WHERE id = ?', [$id]);

            DB::commit();

            return response()->json(['message' => 'Información de equipo eliminada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al eliminar el equipo: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
