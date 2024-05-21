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
            <div id="abilidades" class="doble-column mt-2 grid border p-2 box-shadow">
                <h4 class="mb-2">Habilidades que posee</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_habilidad">Agregar Habilidad</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_habilidades">
                            @foreach(Auth::user()->habilidades as $habilidad)
                            <tr id="tr_habilidad_{{$habilidad->id}}">
                                <td>{{$habilidad->nombre}}</td>
                                <td>{{$habilidad->categoria->nombre}}</td>
                                <td>
                                    <form id="form_delete_habilidad_{{$habilidad->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$habilidad->id}}">
                                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteHabilidad({{$habilidad->id}})">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
            <form class="doble-column grid mb-2 mt-2 border p-2 box-shadow" autocomplete="off" action="{{route('profile.saveInfoLaboral')}}" method="POST">
                @csrf
                <h4 class="doble-column mb-2">Información Laboral</h4>
                <label class="input-group">
                    <span class="input-text">Situación Laboral Actual</span>
                    <select name="situacion_laboral_actual" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                        <option value="Desempleado" @selected($info_laboral->situacion_laboral_actual == 'Desempleado')>Desempleado</option>
                        <option value="Empleado" @selected($info_laboral->situacion_laboral_actual == 'Empleado')>Empleado</option>
                        <option value="Freelancer" @selected($info_laboral->situacion_laboral_actual == 'Freelancer')>Freelancer</option>
                        <option value="En Busqueda de Empleo" @selected($info_laboral->situacion_laboral_actual == 'En Busqueda de Empleo')>En Busqueda de Empleo</option>
                    </select>
                </label>
                <label class="input-group">
                    <span class="input-text">Categoria</span>
                    <select name="categoria_id" class="input">
                        <option value="Ninguna" value="">Ninguna</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}" @selected($info_laboral->categoria_id == $categoria->id)>{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </label>
                <label class="input-group">
                    <span class="input-text">Experiencia Laboral (Años)</span>
                    <input type="number" step="0.1" class="input" name="experiencia_laboral" value="{{$info_laboral->experiencia_laboral}}">
                </label>
                <div class="button-group flex justify-contente-end">
                    <button class="btn verde self-end" type="submit">Guardar</button>
                </div>
            </form>

            <div id="profesiones" class="doble-column grid mb-2 mt-2 border p-2 box-shadow">
                <h4 class="mb-2">Profesiones</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_profesion">Agregar Profesión</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_profesiones">
                            @foreach($info_laboral->profesiones as $profesion)
                            <tr id="tr_profesion_{{$profesion->id}}">
                                <td>{{$profesion->nombre}}</td>
                                <td>{{$profesion->categoria->nombre}}</td>
                                <td>
                                    <form id="form_delete_profesion_{{$profesion->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$profesion->id}}">
                                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteProfesion({{$profesion->id}})">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="trabajos" class="doble-column grid mb-2 mt-2 border p-2 box-shadow">
                <h4 class="mb-2">Trabajos</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_trabajo">Agregar Trabajo</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Institución</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_trabajos">
                            @foreach($info_laboral->trabajos as $trabajo)
                                <tr id="tr_trabajo_{{$trabajo->id}}">
                                    <td>{{$trabajo->nombre}}</td>
                                    <td>{{$trabajo->categoria->nombre}}</td>
                                    <td>{{$trabajo->fecha_inicio}}</td>
                                    <td>{{$trabajo->fecha_fin}}</td>
                                    <td>{{$trabajo->institucion}}</td>
                                    <td>
                                        <form id="form_delete_trabajo_{{$trabajo->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$trabajo->id}}">
                                            <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteTrabajo({{$trabajo->id}})">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="proyectos" class="doble-column grid mb-2 mt-2 border p-2 box-shadow">
                <h4 class="mb-2">Proyectos</h4>
                <div class="buton-group mb-2">
                    <button type="button" class="btn verde open-modal" data-target="modal_agregar_proyecto">Agregar Proyecto</button>
                </div>
                <div class="table-container doble-column">
                    <table class="table-sm" id="usuarios-tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_proyectos">
                            @foreach($info_laboral->proyectos as $proyecto)
                            <tr id="tr_proyecto_{{$proyecto->id}}">
                                <td>{{$proyecto->nombre}}</td>
                                <td>{{$proyecto->categoria->nombre}}</td>
                                <td>{{$proyecto->fecha_inicio}}</td>
                                <td>{{$proyecto->fecha_fin}}</td>
                                <td>
                                    <form id="form_delete_proyecto_{{$proyecto->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$proyecto->id}}">
                                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteProyecto({{$proyecto->id}})">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--modales-->
    <x-modal :id="'modal_agregar_carrera_estudiada'">
        <form id="form_agregar_carrera_estudiada" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Carrera Estudiada</h4>
            <label class="input-group">
                <span class="input-text">Carrera</span>
                <input list="carreras_mas_cursadas" type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Nivel Academico</span>
                <select name="nivel_academico" class="input" required autocomplete="off">
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
        <form id="form_agregar_carrera_por_estudiar" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Carrera Estudiada o Por Estudiar</h4>
            <label class="input-group">
                <span class="input-text">Carrera</span>
                <input list="carreras_mas_cursadas" type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Nivel Academico</span>
                <select name="nivel_academico" class="input" required autocomplete="off">
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

    <x-modal :id="'modal_agregar_habilidad'">
        <form id="form_agregar_habilidad" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Habilidad</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Categoria</span>
                <select name="categoria_id" class="input" required autocomplete="off">
                    <option value="Ninguna" value="">Ninguna</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_habilidad">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal :id="'modal_agregar_profesion'">
        <form id="form_agregar_profesion" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Profesion</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Categoria</span>
                <select name="categoria_id" class="input" required autocomplete="off">
                    <option value="Ninguna" value="">Ninguna</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_profesion">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal :id="'modal_agregar_trabajo'">
        <form id="form_agregar_trabajo" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Trabajo</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Categoria</span>
                <select name="categoria_id" class="input" required autocomplete="off">
                    <option value="">Ninguna</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Inicio</span>
                <input type="date" name="fecha_inicio" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Fin</span>
                <input type="date" name="fecha_fin" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Institución</span>
                <input type="text" name="institucion" class="input" required>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_trabajo">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal :id="'modal_agregar_proyecto'">
        <form id="form_agregar_proyecto" method="POST" class="doble-column grid mb-2 mt-2 w-100">
            @csrf
            <h4 class="doble-column mb-2">Agregar Proyecto</h4>
            <label class="input-group">
                <span class="input-text">Nombre</span>
                <input type="text" name="nombre" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Categoria</span>
                <select name="categoria_id" class="input" required autocomplete="off">
                    <option value="">Ninguna</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Inicio</span>
                <input type="date" name="fecha_inicio" class="input" required>
            </label>
            <label class="input-group">
                <span class="input-text">Fecha de Fin</span>
                <input type="date" name="fecha_fin" class="input" required>
            </label>
            <div class="button-group flex justify-contente-end doble-column">
                <button class="btn verde self-end" type="button" id="btn_agregar_proyecto">Guardar</button>
            </div>
        </form>
    </x-modal>
        
@endsection
@section('scripts')
    <script src="/js/request.js"></script>
    <script src="/js/perfil/index.js"></script>
@endsection