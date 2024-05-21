<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profesion;
use App\Models\Trabajo;
use App\Models\Proyecto;

class InfoLaboralController extends Controller
{
    public function addProfesion(Request $request)
    {
        try
        {
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

    public function addTrabajo(Request $request)
    {
        try
        {
            $request->validate([
                'categoria_id' => 'required'
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => 'Seleccione una categoria valida',
                'data' => null
            ], 400);
        }

        $trabajo = new Trabajo();
        $trabajo->fill($request->all());
        $trabajo->categoria_id = $request->categoria_id;
        $trabajo->info_laboral_id = Auth::user()->infoLaboral->id;

        if($trabajo->save())
        {
            $trabajo->categoria;
            return response()->json([
                'message' => 'Trabajo guardado con exito',
                'data' => $trabajo
            ], 200);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error al guardar el trabajo',
            'data' => $null
        ], 500);
    }

    public function deleteTrabajo(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trabajos,id'
        ]);

        $trabajo = Trabajo::find($request->id);

        if($trabajo->delete())
        {
            return response()->json([
                'message' => 'Trabajo eliminado correctamente',
                'data' => null
            ], 200);
        }

        return response()->json([
            'message' => 'Error al eliminar el trabajo',
            'data' => null
        ], 500);
    }

    public function addProyecto(Request $request)
    {
        try
        {
            $request->validate([
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

        $proyecto = new Proyecto();
        $proyecto->fill($request->all());
        $proyecto->info_laboral_id = Auth::user()->infoLaboral->id;

        if($proyecto->save())
        {
            $proyecto->categoria;
            return response()->json([
                'message' => 'Proyecto guardado correctamente',
                'data' => $proyecto
            ], 200);
        }

        return response()->json([
            'message' => 'Error al guardar el proyecto',
            'data' => null
        ], 500);
    }

    public function deleteProyecto(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:proyectos,id'
        ]);

        $proyecto = Proyecto::find($request->id);

        if($proyecto->delete())
        {
            return response()->json([
                'message' => 'Proyecto eliminado correctamente',
                'data' => null
            ], 200);
        }

        return response()->json([
            'message' => 'Error al eliminar el proyecto',
            'data' => null
        ], 500);
    }
}
