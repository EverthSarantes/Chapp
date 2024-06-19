<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function index()
    {
        return view('estadisticas.index');
    }
}
