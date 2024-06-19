<div id="sidebar" class="verde sidebar-inactive p-2">
    <div>
        <div class="flex justify-content-between">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo Chapp">
            <button type="button" class="btn-toggle-sidebar amarillo">X</button>
        </div>
        <hr class="mt-2 mb-2 c-negro">
        <nav>
            <ul class="flex flex-column list-none gap-1">
                <li><a class="non-link" href="{{route('profile.index')}}">Perfil</a></li>
                <li><a class="non-link" href="{{route('estadisticas.index')}}">Estadísticas</a></li>
            </ul>
        </nav>
    </div>
    <div class="flex flex-column">
        <hr class="mt-2 mb-2 c-negro">
        <a href="{{route('auth.logout')}}" class="non-link">
            Cerrar Sesión
        </a>
    </div>
</div>
<div id="sidebar-overlay" class="sidebar-overlay toggle-sidebar sidebar-overlay-inactive"></div>