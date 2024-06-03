<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Info(title="API de Energy and Water", version="1.0.0")
 */
class CategoriaServicioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/categoria_servicio",
     *     summary="Obtener todas las categorías de servicio",
     *     operationId="getAllCategoriasServicio",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     )
     * )
     */
    public function index()
    {
        $data = DB::select('SELECT id, nombre, imagen, texto, activo FROM categoria_servicio');
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/v1/categoria_servicio/{id}",
     *     summary="Obtener una categoría de servicio por ID",
     *     operationId="getCategoriaServicioById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la categoría de servicio",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
    public function show($id)
    {
        $data = DB::select('SELECT id, nombre, imagen, texto, activo FROM categoria_servicio WHERE id = ?', [$id]);

        if (empty($data)) {
            return response()->json(['message' => 'No se encontraron datos'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/v1/categoria_servicio",
     *     summary="Agregar una nueva categoría de servicio",
     *     operationId="addCategoriaServicio",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "imagen", "texto", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="imagen", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de Categoría de Servicio agregada con éxito"
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
            $request->validate([
                'nombre' => 'required|string',
                'imagen' => 'required|string',
                'texto' => 'required|string',
                'activo' => 'required|boolean',
            ]);

            $result = DB::table('categoria_servicio')->insertGetId([
                'nombre' => $request->nombre,
                'imagen' => $request->imagen,
                'texto' => $request->texto,
                'activo' => $request->activo,
            ]);

            return response()->json(['message' => 'Información de Categoría de Servicio agregada con éxito', 'id' => $result], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            // Captura errores de validación y retorna una respuesta JSON
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al agregar la categoria servicio: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/categoria_servicio/{id}",
     *     summary="Actualizar o crear una categoría de servicio",
     *     operationId="updateOrCreateCategoriaServicio",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la categoría de servicio",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "imagen", "texto", "activo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="imagen", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de categoria_servicio actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Información de categoria_servicio agregada con éxito"
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Ya existe un registro con los datos proporcionados"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al procesar la solicitud"
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'imagen' => 'required|string',
            'texto' => 'required|string',
            'activo' => 'required|boolean',
        ]);

        try {
            $updateResult = DB::update(
                'UPDATE categoria_servicio SET nombre = ?, imagen = ?, texto = ?, activo = ? WHERE id = ?',
                [$request->nombre, $request->imagen, $request->texto, $request->activo, $id]
            );

            if ($updateResult === 0) {
                DB::insert(
                    'INSERT INTO categoria_servicio (id, nombre, imagen, texto, activo) VALUES (?, ?, ?, ?, ?)',
                    [$id, $request->nombre, $request->imagen, $request->texto, $request->activo]
                );
                return response()->json(['message' => 'Información de categoria_servicio agregada con éxito', 'id' => $id], Response::HTTP_CREATED);
            }

            return response()->json(['message' => 'Información de categoria_servicio actualizada con éxito', 'id' => $id], Response::HTTP_OK);
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return response()->json(['message' => 'Ya existe un registro con los datos proporcionados.'], Response::HTTP_CONFLICT);
            } else {
                return response()->json(['message' => 'Error al procesar la solicitud.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/categoria_servicio/{id}",
     *     summary="Eliminar una categoría de servicio por ID",
     *     operationId="deleteCategoriaServicioById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la categoría de servicio",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de categoria_servicio eliminada con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró el id"
     *     )
     * )
     */
    public function destroy($id)
    {
        $result = DB::delete('DELETE FROM categoria_servicio WHERE id = ?', [$id]);

        if ($result === 0) {
            return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Información de categoria_servicio eliminada con éxito'], Response::HTTP_OK);
    }

    /**
     * @OA\Patch(
     *     path="/v1/categoria_servicio/{id}",
     *     summary="Actualizar parcialmente una categoría de servicio",
     *     operationId="partialUpdateCategoriaServicio",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la categoría de servicio",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="imagen", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información de categoria servicio actualizada con éxito"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No hay datos para actualizar"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró el id"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function partialUpdate($id, Request $request)
    {
        $cambiosAplicar = [];
        $hayCambios = false;

        if ($request->has('nombre')) {
            $cambiosAplicar['nombre'] = $request->nombre;
            $hayCambios = true;
        }
        if ($request->has('imagen')) {
            $cambiosAplicar['imagen'] = $request->imagen;
            $hayCambios = true;
        }
        if ($request->has('texto')) {
            $cambiosAplicar['texto'] = $request->texto;
            $hayCambios = true;
        }
        if ($request->has('activo')) {
            $cambiosAplicar['activo'] = $request->activo;
            $hayCambios = true;
        }

        if (!$hayCambios) {
            return response()->json(['message' => 'No hay datos para actualizar'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $resultado = DB::table('categoria_servicio')
                ->where('id', $id)
                ->update($cambiosAplicar);

            if ($resultado === 0) {
                return response()->json(['message' => 'No se encontró el id'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['message' => 'Información de categoria servicio actualizada con éxito'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
