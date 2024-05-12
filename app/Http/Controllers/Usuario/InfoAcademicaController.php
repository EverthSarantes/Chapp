<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarrerasEstudiadas;
use Illuminate\Support\Facades\Auth;

class InfoAcademicaController extends Controller
{
    public function addCarreraEstudiada(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'nivel_academico' => 'required',
            'institucion' => 'required',
        ]);

        $carreraEstudiada = new CarrerasEstudiadas();
        $carreraEstudiada->fill($request->all());
        $carreraEstudiada->info_academica_id = Auth::user()->infoAcademica->id;

        if($carreraEstudiada->save())
        {
            return response()->json([
                'message' => 'Carrera guardada correctamente',
                'data' => $carreraEstudiada
            ], 200);
        }

        return response()->json([
            'message' => 'Error al guardar la carrera',
            'data' => null
        ], 500);
    }

    public function deleteCarreraEstudiada(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carreras_estudiadas,id'
        ]);

        $carreraEstudiada = CarrerasEstudiadas::find($request->id);

        if($carreraEstudiada->delete())
        {
            return response()->json([
                'message' => 'Carrera eliminada correctamente',
                'data' => null
            ], 200);
        }

        return response()->json([
            'message' => 'Error al eliminar la carrera',
            'data' => null
        ], 500);
    }
}
