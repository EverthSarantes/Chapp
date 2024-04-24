@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/form.css">
    <title>{{env('APP_NAME')}} | Iniciar Sesión</title>
@endsection
@section('content')
    <main class="flex-center flex-column">
        <div class="logo-container">
            <img src="/img/logofooter 1.png" alt="logo chapp">
            <h2 class="logo-text">Iniciar Sesión</h2>
        </div>
        <form action="" method="GET" class="form login-form">
            @csrf
            <label class="input-group" for="name">
                <span class="input-text">Usuario</span>
                <input class="input" type="text" name="name" id="name" required>
            </label>
            <label class="input-group" for="password">
                <span class="input-text">Contraseña</span>
                <input class="input" type="password" name="password" id="password" required>
            </label>
            <div class="input-group">
                <a href="/register" class="link">¿No tienes cuenta? Regístrate</a>
            </div>
            <div class="button-group flex-column">
                <button class="btn verde">Entrar</button>
            </div>
        </form>
    </main>
@endsection