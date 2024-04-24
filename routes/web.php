<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estadistica\TablesController;
use App\Http\Controllers\Estadistica\SearchController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    if(auth()->check())
    {
        return redirect()->route('estadisticas');
    }

    return view('login');
});

//rutas de las estadisticas
Route::get('estadisticas', function () {
    return view('estadisticas');
})->name('estadisticas');

Route::prefix('tables')->group(function(){
    Route::get('names', [TablesController::class, 'getNames'])->name('tables.names');
    Route::get('fields/{table}', [TablesController::class, 'getFields'])->name('tables.fields');
    Route::get('relations/{table}', [TablesController::class, 'getRelations'])->name('tables.relations');
});

Route::prefix('search')->group(function(){
    Route::post('', [SearchController::class, 'search'])->name('search');
});

//rutas de la autenticacion
Route::prefix('auth')->group(function(){
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('store', [AuthController::class, 'store'])->name('auth.store');

    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});