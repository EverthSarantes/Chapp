@extends('layouts.app')
@section('head')
    <title>{{env('APP_NAME')}} | Perfil</title>
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/grid.css">
@endsection
@section('content')
    <div class="container">
        <form class="form border p-2 box-shadow grid w-100">
            <h4 class="doble-column mb-2">Información Personal</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input type="text" name="" id="" class="input">
            </label>
            <label class="input-group">
                <span class="input-text">Sexo</span>
                <select name="" id="" class="input">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option>Prefiero no decirlo</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Numero de telefono</span>
                <input type="text" name="" id="" class="input">
            </label>
            <label class="input-group">
                <span class="input-text">Discapacidad</span>
                <input type="text" name="" id="" class="input">
            </label>
            <label class="input-group-textarea doble-column">
                <span class="input-text">Dirección</span>
                <textarea name="" id="" class="textarea"></textarea>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Nacimiento</span>
                <input type="date" name="" id="" class="input">
            </label>
        </form>
        <form class="form border p-2 box-shadow grid w-100">
            <h4 class="doble-column mb-2">Información Academica</h4>
            <label class="input-group">
                <span class="input-text">Nivel academico actual</span>
                <select name="" id="" class="input">
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                    <option value="Universidad">Universidad</option>
                    <option value="Maestria">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                    <option>Ninguno</option>
                </select>
            </label>
        </form>
    </div>
@endsection