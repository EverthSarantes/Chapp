@extends('layouts.app')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/estadistica/index.js')}}"></script>
    <title>{{env('APP_NAME')}} | Estadísticas</title>
@endsection
@section('content')
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 justify-content-center d-flex">
                    <a href="{{route('estadisticas')}}" class="btn btn-success text-center">
                        Estadisticas Avanzadas
                    </a>
                </div>
            </div>
        <div id="carrousel_graficos" class="carousel slide carousel-fade carousel-dark">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <canvas style="width: 100%" id="diagrama_1"></canvas>
                    </div>
                    <div class="carousel-item">
                        <canvas style="width: 100%" id="diagrama_2"></canvas>
                    </div>
                    <div class="carousel-item">
                        <canvas style="width: 100%" id="diagrama_3"></canvas>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_graficos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carrousel_graficos" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
          </div>
    </div>
@endsection

@section('scripts')

    <script>
        const top_categorias = @json($dataTop5);
        const suma_por_sexo = @json($suma_total);
        const promedio_salario = @json($promedio_salario);
    </script>

@endsection