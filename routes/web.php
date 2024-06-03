<?php

use App\Http\Controllers\CategoriaServicioController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\InfoContactoController;
use App\Http\Controllers\MantenimientoInfoController;
use App\Http\Controllers\PreguntaFrecuenteController;
use App\Http\Controllers\HistoriaController;
use Illuminate\Support\Facades\Route;

// Definir un grupo de rutas con el prefijo 'v1'
Route::prefix('v1')->group(function () {

    // Ruta para obtener todas las categorías de servicio
    Route::get('categoria_servicio', [CategoriaServicioController::class, 'index']);

    // Ruta para obtener una categoría de servicio específica por ID
    Route::get('categoria_servicio/{id}', [CategoriaServicioController::class, 'show']);

    // Ruta para agregar una nueva categoría de servicio
    Route::post('categoria_servicio', [CategoriaServicioController::class, 'store']);

    // Ruta para actualizar una categoría de servicio existente por ID
    Route::put('categoria_servicio/{id}', [CategoriaServicioController::class, 'update']);

    // Ruta para eliminar una categoría de servicio por ID
    Route::delete('categoria_servicio/{id}', [CategoriaServicioController::class, 'destroy']);

    // Ruta para actualizar parcialmente una categoría de servicio por ID
    Route::patch('categoria_servicio/{id}', [CategoriaServicioController::class, 'partialUpdate']);

    // Ruta para obtener todos los equipos
    Route::get('equipo', [EquipoController::class, 'index']);

    // Ruta para obtener un equipo específico por ID
    Route::get('equipo/{id}', [EquipoController::class, 'show']);

    // Ruta para agregar un nuevo equipo
    Route::post('equipo', [EquipoController::class, 'store']);

    // Ruta para actualizar o crear un equipo existente por ID
    Route::put('equipo/{id}', [EquipoController::class, 'update']);

    // Ruta para actualizar parcialmente un equipo por ID
    Route::patch('equipo/{id}', [EquipoController::class, 'partialUpdate']);

    // Ruta para eliminar un equipo por ID
    Route::delete('equipo/{id}', [EquipoController::class, 'destroy']);

    // Ruta para obtener una relación equipo-imagen por ID
    Route::get('equipo/{id}', [EquipoController::class, 'equipoFindOne']);

    // Ruta para obtener todas las historias
    Route::get('historia', [HistoriaController::class, 'index']);

    // Ruta para obtener una historia específica por ID
    Route::get('historia/{id}', [HistoriaController::class, 'show']);

    // Ruta para agregar una nueva historia
    Route::post('historia', [HistoriaController::class, 'store']);

    // Ruta para actualizar o crear una historia existente por ID
    Route::put('historia/{id}', [HistoriaController::class, 'update']);

    // Ruta para actualizar parcialmente una historia por ID
    Route::patch('historia/{id}', [HistoriaController::class, 'partialUpdate']);

    // Ruta para eliminar una historia por ID
    Route::delete('historia/{id}', [HistoriaController::class, 'destroy']);

    // Ruta para obtener toda la información de contacto
    Route::get('info_contacto', [InfoContactoController::class, 'index']);

    // Ruta para obtener información de contacto específica por ID
    Route::get('info_contacto/{id}', [InfoContactoController::class, 'show']);

    // Ruta para agregar nueva información de contacto
    Route::post('info_contacto', [InfoContactoController::class, 'store']);

    // Ruta para actualizar o crear información de contacto existente por ID
    Route::put('info_contacto/{id}', [InfoContactoController::class, 'update']);

    // Ruta para actualizar parcialmente información de contacto por ID
    Route::patch('info_contacto/{id}', [InfoContactoController::class, 'partialUpdate']);

    // Ruta para eliminar información de contacto por ID
    Route::delete('info_contacto/{id}', [InfoContactoController::class, 'destroy']);

    // Ruta para obtener toda la información de mantenimiento
    Route::get('mantenimiento_info', [MantenimientoInfoController::class, 'index']);

    // Ruta para obtener información de mantenimiento específica por ID
    Route::get('mantenimiento_info/{id}', [MantenimientoInfoController::class, 'show']);

    // Ruta para agregar nueva información de mantenimiento
    Route::post('mantenimiento_info', [MantenimientoInfoController::class, 'store']);

    // Ruta para actualizar o crear información de mantenimiento existente por ID
    Route::put('mantenimiento_info/{id}', [MantenimientoInfoController::class, 'update']);

    // Ruta para actualizar parcialmente información de mantenimiento por ID
    Route::patch('mantenimiento_info/{id}', [MantenimientoInfoController::class, 'partialUpdate']);

    // Ruta para eliminar información de mantenimiento por ID
    Route::delete('mantenimiento_info/{id}', [MantenimientoInfoController::class, 'destroy']);

    // Ruta para obtener todas las preguntas frecuentes
    Route::get('pregunta_frecuente', [PreguntaFrecuenteController::class, 'index']);

    // Ruta para obtener una pregunta frecuente específica por ID
    Route::get('pregunta_frecuente/{id}', [PreguntaFrecuenteController::class, 'show']);

    // Ruta para agregar nueva pregunta frecuente
    Route::post('pregunta_frecuente', [PreguntaFrecuenteController::class, 'store']);

    // Ruta para actualizar o crear una pregunta frecuente existente por ID
    Route::put('pregunta_frecuente/{id}', [PreguntaFrecuenteController::class, 'update']);

    // Ruta para actualizar parcialmente una pregunta frecuente por ID
    Route::patch('pregunta_frecuente/{id}', [PreguntaFrecuenteController::class, 'partialUpdate']);

    // Ruta para eliminar una pregunta frecuente por ID
    Route::delete('pregunta_frecuente/{id}', [PreguntaFrecuenteController::class, 'destroy']);
});
