<?php
//util
use Illuminate\Support\Facades\Route;

//site
use App\Http\Controllers\site\SiteController;

//cliente
use App\Http\Controllers\cliente\ClienteDashboardController;

//admin
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SalaController;
use App\Http\Controllers\admin\ReservaController;
use App\Http\Controllers\admin\RelatorioController;
use App\Http\Controllers\admin\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


Route::get('/', [SiteController::class, 'index']);


Route::middleware(['auth'])->group(function () {

    Route::get('/cliente', [ClienteDashboardController::class, 'index']);

});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminDashboardController::class, 'index']);
    Route::get('/admin/salas', [SalaController::class, 'index']);
    Route::get('/admin/reservas', [ReservaController::class, 'index']);
    Route::get('/admin/relatorios', [RelatorioController::class, 'index']);
    Route::get('/admin/usuarios', [UsuarioController::class, 'index']);

});








require __DIR__.'/auth.php';
