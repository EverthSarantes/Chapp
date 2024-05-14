@extends('layouts.app')
@section('head')
    <title>{{env('APP_NAME')}} | Perfil</title>
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/tables.css">
    <link rel="stylesheet" href="/css/dialog.css">
@endsection
@section('content')
    <div class="container">
        <form action="{{route('profile.store')}}" class="form border p-2 box-shadow grid w-100" autocomplete="off" method="POST">
            @csrf
            <h4 class="doble-column mb-2">Información Personal</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input value="{{$perfil->nombre}}" type="text" name="nombre" id="nombre" class="input">
            </label>
            <label class="input-group">
                <span class="input-text">Sexo</span>
                <select name="sexo" id="sexo" class="input">
                    <option value="M" @if($perfil->sexo == 'M') selected @endif>Masculino</option>
                    <option value="F" @if($perfil->sexo == 'F') selected @endif>Femenino</option>
                    <option value="">Prefiero no decirlo</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Numero de telefono</span>
                <input value="{{$perfil->telefono}}" type="text" name="telefono" id="telefono" class="input">
            </label>
            <label class="input-group">
                <span class="input-text">Discapacidad</span>
                <input value="{{$perfil->discapacidad}}" type="text" name="discapacidad" id="discapacidad" class="input">
            </label>
            <label class="input-group-textarea doble-column">
                <span class="input-text">Dirección</span>
                <textarea name="direccion" id="direccion" class="textarea">{{$perfil->direccion}}</textarea>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Nacimiento</span>
                <input value="{{$perfil->fecha_nacimiento}}" type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="input">
            </label>
            <label class="input-group">
                <span class="input-text">Expectativa Salarial (Dolares)</span>
                <input value="{{$perfil->expectativa_salarial}}" type="number" min="1" name="expectativa_salarial" id="expectativa_salarial" class="input">
            </label>
            <div class="button-group doble-column">
                <button class="btn verde" type="submit">Guardar</button>
                <button class="btn rojo" type="reset">Limpiar</button>
            </div>
        </form>
        <div class="form grid w-100">
            <form action="{{route('profile.saveInfoAcademica')}}" method="POST" class="doble-column grid mb-2 mt-2 border p-2 box-shadow" autocomplete="off">
                @csrf
                <h4 class="doble-column mb-2">Información Academica</h4>
                <label class="input-group">
                    <span class="input-text">Nivel academico actual</span>
                    <select name="nivel_academico" id="nivel_academico" class="input" autocomplete="off">
                        <option value="Ninguna" @if($info_academica->nivel_academico == 'Ninguna') selected @endif>Ninguna</option>
                        <option value="Primaria" @if($info_academica->nivel_academico == 'Primaria') selected @endif>Primaria</option>
                        <option value="Secundaria" @if($info_academica->nivel_academico == 'Secundaria') selected @endif>Secundaria</option>
                        <option value="Tecnico" @if($info_academica->nivel_academico  == 'Tecnico') selected @endif>Tecnico</option>
                        <option value="Universidad" @if($info_academica->nivel_academico == 'Universidad') selected @endif>Universidad</option>
                        <option value="Maestria" @if($info_academica->nivel_academico == 'Maestria') selected @endif>Maestria</option>
                        <option value="Doctorado" @if($info_academica->nivel_academico == 'Doctorado') selected @endif>Doctorado</option>
                    </select>
                </label>
                <div class="button-group flex justify-contente-end">
                    <button class="btn verde self-end" type="submit">Guardar</button>
                </div>
            </form>
            <div id="carreras_estudiadas" class="doble-column mb-2 mt-2 grid border p-2 box-shadow">
                <h4 class="mb-2">Carreras Estudiadas</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_carrera_estudiada">Agregar Carrera</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Nivel Academico</th>
                                <th>Institución</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_carreras_estudiadas">
                            @foreach($info_academica->carrerasEstudiadas as $carrera)
                                <tr id="tr_carrera_estudiada_{{$carrera->id}}">
                                    <td>{{$carrera->nombre}}</td>
                                    <td>{{$carrera->nivel_academico}}</td>
                                    <td>{{$carrera->institucion}}</td>
                                    <td>
                                        <form id="form_delete_carrera_estudiada_{{$carrera->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$carrera->id}}">
                                            <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteCarreraEstudiada({{$carrera->id}})">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="carreras_estudiar" class="doble-column mb-2 mt-2 grid border p-2 box-shadow">
                <h4 class="mb-2">Carreras que estudia o le gustaría estudiar</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_carrera_por_estudiar">Agregar Carrera</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Nivel Academico</th>
                                <th>Institución</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_carreras_por_estudiar">
                            @foreach($info_academica->carrerasPorEstudiar as $carrera)
                            <tr id="tr_carrera_por_estudiar_{{$carrera->id}}">
                                <td>{{$carrera->nombre}}</td>
                                <td>{{$carrera->nivel_academico}}</td>
                                <td>{{$carrera->institucion}}</td>
                                <td>
                                    <form id="form_delete_carrera_por_estudiar_{{$carrera->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$carrera->id}}">
                                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteCarreraPorEstudiar({{$carrera->id}})">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="abilidades" class="doble-column mb-2 mt-2 grid border p-2 box-shadow">
                <h4 class="mb-2">Habilidades que posee</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde">Agregar Habilidad</button>
                </div>
                <label class="input-group">
                    <span class="input-text">Nombre</span>
                    <input type="text" name="habilidad[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Categoria</span>
                    <select name="categoria_habilidad[]" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                    </select>
                </label>
            </div>
            <datalist id="carreras_mas_cursadas">
                <option value="Ingeniería de Sistemas">
                <option value="Administración de Empresas">
                <option value="Medicina">
                <option value="Derecho">
                <option value="Psicología">
                <option value="Ingeniería Civil">
                <option value="Ingeniería Industrial">
                <option value="Ingeniería Electrónica">
                <option value="Diseno Grafico">
                <option value="Arquitectura">
                <option value="Contabilidad">
            </datalist>
        </div>

        <div class="form mb-2 grid w-100">
            <h4 class="doble-column mb-2">Información Laboral</h4>
            <label class="input-group">
                <span class="input-text">Situación Laboral Actual</span>
                <select name="situacion_actual" class="input">
                    <option value="Ninguna" value="">Ninguna</option>
                    <option value="Desempleado">Desempleado</option>
                    <option value="Empleado">Empleado</option>
                    <option value="Freelancer">Freelancer</option>
                    <option value="En Busqueda de Empleo">En Busqueda de Empleo</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Categoria</span>
                <select name="categoria_laboral_actual[]" class="input">
                    <option value="Ninguna" value="">Ninguna</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Experiencia Laboral (Años)</span>
                <input type="number" class="input" name="experiencia_laboral">
            </label>

            <div id="profesiones" class="doble-column mt-2 mb-2 grid">
                <h4 class="mb-2">Profesiones</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde">Agregar Profesión</button>
                </div>
                <label class="input-group">
                    <span class="input-text">Nombre</span>
                    <input type="text" name="profesion[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Categoria</span>
                    <select name="categoria_profesion[]" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                    </select>
                </label>
            </div>

            <div id="trabajos" class="doble-column mt-2 mb-2 grid">
                <h4 class="mb-2">Trabajos</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde">Agregar Trabajo</button>
                </div>
                <label class="input-group">
                    <span class="input-text">Nombre</span>
                    <input type="text" name="trabajo[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Categoria</span>
                    <select name="categoria_trabajo[]" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                    </select>
                </label>
                <label class="input-group">
                    <span class="input-text">Fecha de Inicio</span>
                    <input type="date" name="fecha_inicio_trabajo[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Fecha de Fin</span>
                    <input type="date" name="fecha_fin_trabajo[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Institución</span>
                    <input type="text" name="institucion_trabajo[]" class="input">
                </label>
            </div>

            <div id="proyectos" class="doble-column mt-2 mb-2 grid">
                <h4 class="mb-2">Proyectos</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde">Agregar Proyecto</button>
                </div>
                <label class="input-group">
                    <span class="input-text">Nombre</span>
                    <input type="text" name="proyecto[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Categoria</span>
                    <select name="categoria_proyecto[]" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                    </select>
                </label>
                <label class="input-group">
                    <span class="input-text">Fecha de Inicio</span>
                    <input type="date" name="fecha_inicio_proyecto[]" class="input">
                </label>
                <label class="input-group">
                    <span class="input-text">Fecha de Fin</span>
                    <input type="date" name="fecha_fin_proyecto[]" class="input">
                </label>
            </div>
        </div>
    </div>

    <!--modales-->
    <x-modal :id="'modal_agregar_carrera_estudiada'">
        <form id="form_agregar_carrera_estudiada" method="POST" class="doble-column grid mb-2 mt-2 w-100" autocomplete="off">
            @csrf
            <h4 class="doble-column mb-2">Agregar Carrera Estudiada</h4>
            <label class="input-group">
                <span class="input-text">Carrera</span>
                <input list="carreras_mas_cursadas" type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Nivel Academico</span>
                <select name="nivel_academico" class="input" required>
                    <option value="Ninguna" value="">Ninguna</option>
                    <option value="Tecnico">Tecnico</option>
                    <option value="Ingenieria">Ingenieria</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Maestria">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Institución</span>
                <input type="text" name="institucion" class="input" required>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_carrera_estudiada">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal :id="'modal_agregar_carrera_por_estudiar'">
        <form id="form_agregar_carrera_por_estudiar" method="POST" class="doble-column grid mb-2 mt-2 w-100" autocomplete="off">
            @csrf
            <h4 class="doble-column mb-2">Agregar Carrera Estudiada o Por Estudiar</h4>
            <label class="input-group">
                <span class="input-text">Carrera</span>
                <input list="carreras_mas_cursadas" type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Nivel Academico</span>
                <select name="nivel_academico" class="input" required>
                    <option value="Ninguna" value="">Ninguna</option>
                    <option value="Tecnico">Tecnico</option>
                    <option value="Ingenieria">Ingenieria</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Maestria">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Institución</span>
                <input type="text" name="institucion" class="input" required>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_carrera_por_estudiar">Guardar</button>
            </div>
        </form>
    </x-modal>
        
@endsection
@section('scripts')
    <script src="/js/request.js"></script>
    <script src="/js/perfil/index.js"></script>
@endsection