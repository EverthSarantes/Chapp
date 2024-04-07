<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estadistica\TablesController;
use App\Http\Controllers\Estadistica\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('tables')->group(function(){
    Route::get('names', [TablesController::class, 'getNames'])->name('tables.names');
    Route::get('fields/{table}', [TablesController::class, 'getFields'])->name('tables.fields');
});

Route::prefix('search')->group(function(){
    Route::post('', [SearchController::class, 'search'])->name('search');
});
