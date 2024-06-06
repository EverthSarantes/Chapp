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
                    <li class="color-text"><a href="{{route('login')}}" class="login-button ">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container" id="container">
        <div class="display-flex bottom-margin">
            <div class="left-margin-110px top-margin-40px">
                <h1 class="font-size">
                    El Puente Entre Tu <br>
                    <span class="color-lightgreen">Talento</span> y
                    <span class="color-lightblue">Oportunidades</span> <br>
                    Ilimitadas.
                </h1>

                <h3 class="top-margin-20px">
                    Da el paso al siguiente nivel y oferta tus habilidades <br> técnicas y profecionales
                </h3>

                <div class="btn top-margin-10px center color-white link-none-style">
                    <a href="auth/register">Registrarse</a>
                </div>
            </div>
            <div class="float-right right-margin-110px top-margin-70px ">
                <img class="img-size" src="{{ asset('images/landing.png') }}" alt="Landing">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="background-5792AD">
            <div>
                <div class="text-center color-white">
                    <div class="text-size-24px">
                        <h2 class="padding-top-20px">
                            Compañias que confian en nosotros
                        </h2>
                    </div>
                    <p class="text-size-20px pading-top">
                        Las principales compañias usan Chapp para contratar servicos tecnicos y profecionales
                    </p>
                </div>


                <div class="display-flex center-contend">
                    <div class="image-with pading">
                        <img class="img-size" src="{{ asset('images/logo_2.png') }}" alt="Landing">
                        <img class="img-size" src="{{ asset('images/logo_3.png') }}" alt="Landing">
                        <img class="img-size" src="{{ asset('images/logo_4.png') }}" alt="Landing">
                        <img class="img-size" src="{{ asset('images/logo_5.png') }}" alt="Landing">
                        <img class="img-size" src="{{ asset('images/logo_6.png') }}" alt="Landing">
                        <img class="img-size" src="{{ asset('images/logo_7.png') }}" alt="Landing">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="padding-top-20px text-center">
            <h3 class="text-size-24px">
                Funcionalidades
            </h3>
            <p class="text-size-20px padding-top-10px">
                Te facilitamos la tarea de ofertar tus servicios
            </p>

        </div>

        <div id="cards" class="flex-display pading-card padding-top-20px center-contend">

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

    <footer class="container">
        <div class="background-5792AD display-flex">
            <div class="left-margin-110px">
                <div class="top-margin-40px">
                    <img class="img-size-50px" src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="color-white">
                    <h6 class="top-margin-20px">
                        © 2021 Chapp, Inc. <br>
                        All rights reserved
                    </h6>

                    <div id="socialmedia" class="top-margin-40px">
                        <img src="{{ asset('images/socialmedia/Social Icons.png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (1).png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (2).png') }}" alt="">
                        <img src="{{ asset('images/socialmedia/Social Icons (3).png') }}" alt="">
                    </div>
                </div>

            </div>

            <div class="flex-display pading-card right-margin-110px color-white top-margin-40px none-list-style link-none-style">
                <div>
                    <h4 class="font-size-18px">
                        Compañia
                    </h4>

                    <ul class="top-margin-20px margin-link">
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Politicas de Privacidad</a></li>
                        <li><a href="#">Terminos de Uso</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-size-18px">
                        Soporte
                    </h4>

                    <ul class="top-margin-20px margin-link">
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