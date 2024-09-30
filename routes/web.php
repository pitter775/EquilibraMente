<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('site.index'); // Aqui você criará a página inicial do site
});
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente', function () {
        return view('cliente.dashboard');
    });
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

require __DIR__.'/auth.php';
