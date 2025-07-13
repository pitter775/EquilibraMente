<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AtividadeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('atividades')->group(function () {
    Route::get('/', [AtividadeController::class, 'index']);
    Route::post('/', [AtividadeController::class, 'store']);
    Route::get('/{id}', [AtividadeController::class, 'show']);
    Route::put('/{id}', [AtividadeController::class, 'update']);
    Route::delete('/{id}', [AtividadeController::class, 'destroy']);
});
