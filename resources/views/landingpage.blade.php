<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    <header>
        <div class="nav-container">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
            <nav>
                <ul class="nav-bar">
                    <li><a href="#">Subscripciones</a></li>
                    <li><a href="#">Trabajos</a></li>
                    <li><a href="#">Articulos</a></li>
                    <li class="color-text"><a href="#" class="login-button ">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container" id="container">
        <div class="display-flex">
            <div class="left-margin-110px top-margin-40px">
                <h1 class="font-size">
                    El Puente Entre Tu <br> 
                    <span class="color-lightgreen">Talento</span> y
                    <span class="color-lightblue">Oportunidades</span> <br> 
                    Ilimitadas.
                </h1>

                <h3 class="top-margin-20px">
                    Da el paso al siguiente nivel y oferta tus habilidades <br>  técnicas y profecionales
                </h3>

                <button class="btn top-margin-10px">Registrate</button>
            </div>
            <div class="float-right right-margin-110px top-margin-70px ">
                <img class="img-size" src="{{ asset('images/landing.png') }}" alt="Landing">
            </div>
        </div>
    </div>
    <div>

    </div>
</body>

</html>