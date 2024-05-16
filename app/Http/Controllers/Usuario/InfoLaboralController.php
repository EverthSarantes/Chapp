<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profesion;

class InfoLaboralController extends Controller
{
    public function addProfesion(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required',
                'categoria_id' => 'required|exists:categorias,id'
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => 'Seleccione una categoria valida',
                'data' => null
            ], 400);
        }

        $profesion = new Profesion();
        $profesion->fill($request->all());
        $profesion->info_laboral_id = Auth::user()->infoLaboral->id;

        if($profesion->save())
        {
            $profesion->categoria;
            return response()->json([
                'message' => 'Profesion guardada correctamente',
                'data' => $profesion
            ], 200);
        }

        return response()->json([
            'message' => 'Error al guardar la profesion',
            'data' => null
        ], 500);
    }

    public function deleteProfesion(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:profesions,id'
        ]);

        $profesion = Profesion::find($request->id);

        if($profesion->delete())
        {
            return response()->json([
                'message' => 'Profesion eliminada correctamente',
                'data' => null
            ], 200);
        }

        return response()->json([
            'message' => 'Error al eliminar la profesion',
            'data' => null
        ], 500);
    }
}
