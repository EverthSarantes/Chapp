<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estadistica\TablesController;
use App\Http\Controllers\Estadistica\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Usuario\PerfilController;
use App\Http\Controllers\Usuario\InfoAcademicaController;
use App\Http\Controllers\Usuario\InfoLaboralController;

Route::get('login', function () {
    if(auth()->check())
    {
        return redirect()->route('panel');
    }
    return view('login');
})->name('login');

Route::get('/', function () {
    return view('landingpage');
})->name('/');

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
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

//rutas de la aplicación
Route::middleware('auth')->group(function(){
    //rutas del panel
    Route::get('home', function(){return view('panel');})->name('panel');

    //rutas del perfil
    Route::prefix('profile')->group(function(){
        Route::get('index', [PerfilController::class, 'index'])->name('profile.index');
        Route::post('store', [PerfilController::class, 'store'])->name('profile.store');
        Route::post('saveInfoAcademica', [PerfilController::class, 'saveInfoAcademica'])->name('profile.saveInfoAcademica');
        Route::post('saveInfoLaboral', [PerfilController::class, 'saveInfoLaboral'])->name('profile.saveInfoLaboral');
    }); 
});

//rutas de api
Route::prefix('api')->middleware('auth')->group(function(){
    Route::prefix('info/academica')->group(function(){
        Route::post('addCarreraEstudiada', [InfoAcademicaController::class, 'addCarreraEstudiada']);
        Route::delete('deleteCarreraEstudiada', [InfoAcademicaController::class, 'deleteCarreraEstudiada'])->name('info.academica.deleteCarreraEstudiada');
        Route::post('addCarreraPorEstudiar', [InfoAcademicaController::class, 'addCarreraPorEstudiar']);
        Route::delete('deleteCarreraPorEstudiar', [InfoAcademicaController::class, 'deleteCarreraPorEstudiar'])->name('info.academica.deleteCarreraPorEstudiar');
        Route::post('addHabilidad', [InfoAcademicaController::class, 'addHabilidad']);
        Route::delete('deleteHabilidad', [InfoAcademicaController::class, 'deleteHabilidad'])->name('info.academica.deleteHabilidad');
    });

    Route::prefix('info/laboral')->group(function(){
        Route::post('addProfesion', [InfoLaboralController::class, 'addProfesion']);
        Route::delete('deleteProfesion', [InfoLaboralController::class, 'deleteProfesion'])->name('info.laboral.deleteProfesion');
        Route::post('addTrabajo', [InfoLaboralController::class, 'addTrabajo']);
        Route::delete('deleteTrabajo', [InfoLaboralController::class, 'deleteTrabajo'])->name('info.laboral.deleteTrabajo');
        Route::post('addProyecto', [InfoLaboralController::class, 'addProyecto']);
        Route::delete('deleteProyecto', [InfoLaboralController::class, 'deleteProyecto'])->name('info.laboral.deleteProyecto');
    });
});