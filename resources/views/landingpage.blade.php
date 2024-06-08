<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basics.css') }}">
</head>

<body>
    <header>
        <div class="nav-container">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
            <nav>
                <ul class="nav-bar">
                    <li><a href="#" class="c-blanco nav-link">Subscripciones</a></li>
                    <li><a href="#" class="c-blanco nav-link">Trabajos</a></li>
                    <li><a href="#" class="c-blanco nav-link">Articulos</a></li>
                    <li><a href="{{route('login')}}" class="btn blanco">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="landing-container" id="container">
        <div id="hero" class="flex flex-center gap-2 p-2">
            <div>
                <h1 class="font-size">
                    El Puente Entre Tu <br>
                    <span class="color-lightgreen">Talento</span> y
                    <span class="color-lightblue">Oportunidades</span> <br>
                    Ilimitadas.
                </h1>
                <h3>
                    Da el paso al siguiente nivel y oferta tus habilidades <br> técnicas y profecionales
                </h3>
                <div class="w-50">
                    <a href="auth/register" class="btn verde non-link">Registrarse</a>
                </div>
            </div>
            <div>
                <img class="img-size" src="{{ asset('images/landing.png') }}" alt="Landing">
            </div>
        </div>
    </div>
    <div class="landing-container">
        <div class="background-5792AD">
            <div class="p-2">
                <div class="text-center color-white">
                    <div class="text-size-24px">
                        <h2>
                            Compañias que confian en nosotros
                        </h2>
                    </div>
                    <p class="text-size-20px">
                        Las principales compañias usan Chapp para contratar servicos tecnicos y profecionales
                    </p>
                </div>
                <div class="flex flex-center mt-2">
                    <div class="flex flex-center flex-wrap w-100 gap-3">
                        <img class="img" src="{{ asset('images/logo_2.png') }}" alt="Landing">
                        <img class="img" src="{{ asset('images/logo_3.png') }}" alt="Landing">
                        <img class="img" src="{{ asset('images/logo_4.png') }}" alt="Landing">
                        <img class="img" src="{{ asset('images/logo_5.png') }}" alt="Landing">
                        <img class="img" src="{{ asset('images/logo_6.png') }}" alt="Landing">
                        <img class="img" src="{{ asset('images/logo_7.png') }}" alt="Landing">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="landing-container">
        <div class="padding-top-20px text-center">
            <h3 class="text-size-24px">
                Funcionalidades
            </h3>
            <p class="text-size-20px padding-top-10px">
                Te facilitamos la tarea de ofertar tus servicios
            </p>

        </div>

        <div id="cards" class="flex-display flex-wrap pading-card padding-top-20px center-contend">

            <div id="card1" class="card">
                <div class="flex-display center-contend">
                    <img class="cards-img-with" src="{{ asset('images/team-building 1.png') }}" alt="team">
                </div>

                <div class="text-center">
                    <h4 class="padding-top-10px text-size-20px">Equipos</h4>
                    <p class="padding-top-10px">
                        Crea tu equipo de trabajo agregando miembros que esten registrados
                    </p>

                </div>

            </div>

            <div id="card2" class="card">
                <div class="flex-display center-contend">
                    <img class="cards-img-with" src="{{ asset('images/ofrecimiento 1.png') }}" alt="team">
                </div>

                <div class="text-center">
                    <h4 class="padding-top-10px text-size-20px">Aumenta tu flujo de trabajo</h4>
                    <p class="padding-top-10px">
                        Ten acceso a una amplia gama de posibles trabajos que ofertan las empresas y otros usuarios
                    </p>

                </div>

            </div>

            <div id="card3" class="card">
                <div class="flex-display center-contend">
                    <img class="cards-img-with" src="{{ asset('images/red 1.png') }}" alt="team">
                </div>

                <div class="text-center">
                    <h4 class="padding-top-10px text-size-20px">Conecta</h4>
                    <p class="padding-top-10px">
                        Conoce a personas de distintos rubros de trabajo
                    </p>

                </div>

            </div>

        </div>
    </div>

    <footer class="landing-container">
        <div class="background-5792AD flex justify-content-between flex-wrap p-2">
            <div id="descripcion" class="w-25 flex flex-center flex-column">
                <div class="">
                    <img class="img-size-50px" src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="color-white">
                    <h6 class="">
                        © 2024 Chapp, Inc. <br>
                        All rights reserved
                    </h6>

                    <div id="socialmedia" class="">
                        <img src="{{ asset('images/socialmedia/Social Icons.png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (1).png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (2).png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (3).png') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap justify-contente-end color-white none-list-style link-none-style w-75">
                <div class="w-50">
                    <h4 class="font-size-18px">
                        Compañia
                    </h4>

                    <ul class="">
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Politicas de Privacidad</a></li>
                        <li><a href="#">Terminos de Uso</a></li>
                    </ul>
                </div>

                <div class="w-50">
                    <h4 class="font-size-18px">
                        Soporte
                    </h4>

                    <ul class="">
                        <li><a href="#">Centro de ayuda</a></li>
                        <li><a href="#">Terminos de servicio</a></li>
                        <li><a href="#">Legal</a></li>
                        <li><a href="#">Politicas de privacidad</a></li>
                        <li><a href="#">Estado</a></li>
                    </ul>
                </div>
            </div>
        </div>


    </footer>

</body>

</html>