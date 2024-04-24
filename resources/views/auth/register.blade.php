@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/form.css">
    <title>{{env('APP_NAME')}} | Registro</title>
@endsection
@section('content')
    <main class="flex-center flex-column">
        <div class="logo-container">
            <img src="/img/logofooter 1.png" alt="logo chapp">
            <h2 class="logo-text">Registro</h2>
        </div>
        <form action="{{route('auth.store')}}" method="POST" class="form login-form">
            @csrf
            <label class="input-group" for="name">
                <span class="input-text">Usuario</span>
                <input class="input" type="text" name="name" id="name" required>
            </label>
            <label class="input-group" for="password">
                <span class="input-text">Contraseña</span>
                <input class="input" type="password" name="password" id="password" required>
            </label>
            <div class="button-group flex-column">
                <button class="btn verde">Crear Usuario</button>
            </div>
        </form>
    </main>
@endsection