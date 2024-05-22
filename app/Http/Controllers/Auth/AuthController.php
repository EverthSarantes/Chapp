<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;
use App\Models\InfoAcademica;
use App\Models\InfoLaboral;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if(User::where('name', $request->name)->exists()){
            return redirect()->route('auth.register')->with([
                'message' => 'El usuario ya existe',
                'type' => 'rojo'
            ]);
        }

        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();

            $perfil = new Perfil();
            $perfil->nombre = $request->name;
            $perfil->user_id = $user->id;
            $perfil->save();

            $infoAcademica = new InfoAcademica();
            $infoAcademica->user_id = $user->id;
            $infoAcademica->save();

            $infoLaboral = new InfoLaboral();
            $infoLaboral->user_id = $user->id;
            $infoLaboral->save();

            DB::commit();
            return redirect()->back()->with([
                'message' => 'Usuario registrado correctamente',
                'type' => 'verde'
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Error al registrar el usuario'. $e->getMessage(),
                'type' => 'rojo'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Error al registrar el usuario',
            'type' => 'rojo'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            
            return redirect()->route('panel');
        }

        return redirect()->back()->with([
            'message' => 'Usuario o contraseña incorrectos',
            'type' => 'rojo'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('/');
    }
}
