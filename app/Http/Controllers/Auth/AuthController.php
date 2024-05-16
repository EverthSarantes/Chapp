<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);

        if($user->save())
        {
            return redirect()->back()->with([
                'message' => 'Usuario registrado correctamente',
                'type' => 'verde'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Error al registrar el usuario',
            'type' => 'verde'
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
