<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/students', [studentController::class, 'index']);

Route::get('/students/{id}', function (){
    return `Obteniedo el Estudiante con el id`;
});

Route::post('/students/', function (){
    return 'Creando un nuevo Estudiante';
});

Route::put('/students/{id}', function (){
    return 'Actualizando Estudiante';
});

Route::delete('/students/{id}', function (){
    return 'Eliminando Estudiante';
});
