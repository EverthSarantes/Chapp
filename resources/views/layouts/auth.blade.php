<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('head')
</head>
<body>
    @if ($errors->any())
        <div class="rojo" onclick="this.remove()">
            <p onclick="this.parentNode.remove()">Ha ocurrido un error, por favor intentelo de nuevo</p>
        </div>
    @endif
    @if(session('message'))
        <x-message :message="session('message')" :color="session('type') ?? 'verde'"/>
    @endif
    @yield('content')
</body>
@yield('scripts')
</html>