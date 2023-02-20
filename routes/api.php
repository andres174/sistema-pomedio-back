<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PromController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('estudiantes', EstudianteController::class);
Route::get('estudiantes-sin-nota', [EstudianteController::class, 'getEstudiantesSinNota']);
Route::get('estudiantes-con-nota', [EstudianteController::class, 'getEstudiantesConNota']);
Route::get('estudiantes-sin-prom', [EstudianteController::class, 'getEstudiantesSinProm']);
Route::get('estudiantes-con-prom', [EstudianteController::class, 'getEstudiantesConProm']);

Route::resource('notas', NotaController::class);
Route::resource('promedios', PromController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
