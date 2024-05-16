<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use App\Models\InfoAcademica;
use App\Models\Categoria;

class PerfilController extends Controller
{
    public function index()
    {
        $perfil = Auth::user()->perfil ?? new Perfil();
        $info_academica = Auth::user()->infoAcademica ?? new InfoAcademica();
        $categorias = Categoria::all();
        return view('perfil.index', compact('perfil', 'info_academica', 'categorias'));
    }

    public function store(Request $requet)
    {
        $perfil = Auth::user()->perfil ?? new Perfil();

        $perfil->fill($requet->all());
        $perfil->user_id = Auth::id();
        $perfil->save();

        return redirect()->back()->with([
            'message' => 'Perfil guardado correctamente',
            'type' => 'verde'
        ]);
    }

    public function saveInfoAcademica(Request $requet)
    {
        $perfil = Auth::user()->infoAcademica ?? new InfoAcademica();

        $perfil->fill($requet->all());
        $perfil->user_id = Auth::id();
        
        if($perfil->save())
        {
            return redirect()->back()->with([
                'message' => 'Perfil guardado correctamente',
                'type' => 'verde'
            ]);
        
        }

        return redirect()->back()->with([
            'message' => 'Error al guardar el perfil',
            'type' => 'rojo'
        ]);
    }
}
