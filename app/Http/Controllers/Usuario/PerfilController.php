<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;
use Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $perfil = Auth::user()->perfil ?? new Perfil();
        //dd($perfil);
        return view('perfil.index', compact('perfil'));
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
}
