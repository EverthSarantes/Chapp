<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="/css/table.css">
    <title>Prueba</title>
</head>
<body>
    <section class="container mt-4">
        <h2 class="mt-1">Sistema de Estadisticas</h2>

        <form class="row mt-2 p-1 border border-secondary rounded" id="search-form">
            @csrf
            <div class="col-md-6 mb-3">
                <label for="table-selector" class="form-label">Tabla</label>
                <select class="form-select" id="table-selector" name="table" autocomplete="off" required>
                    <option value="">Seleccione una tabla</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="fiels-amount" class="form-label">Cantidad de Registros</label>
                <input class="form-control" id="fiels-amount" name="fiels_amount" type="number" min="1" value="10" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="order-selector" class="form-label">Orden</label>
                <select class="form-select" id="order-selector" name="order">
                    <option value="">Seleccione un orden</option>
                    <option value="ASC">Ascendente</option>
                    <option value="DESC">Descendente</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="order-column-selector" class="form-label">Ordenar por</label>
                <select class="form-select" id="order-column-selector" name="order_column">
                    <option value="">Seleccione una columna</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="operation-selector" class="form-label">Operacion</label>
                <select class="form-select" id="operation-selector" name="operation">
                    <option value="get">Obtener los datos</option>
                    <option value="first">Obtener el primer registro</option>
                    <option value="last">Obtener el ultimo registro</option>
                    <option value="sql">Obtener Sentencia SQL</option>
                    <option value="count">Contar</option>
                    <option value="sum">Sumar</option>
                    <option value="avg">Promedio</option>
                    <option value="max">Maximo</option>
                    <option value="min">Minimo</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="operation-column-selector" class="form-label">Operar por</label>
                <select class="form-select" id="operation-column-selector" name="operation_column">
                    <option value="">Seleccione una columna</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Columnas</label>
                <div id="columns-selectors" class="p-1 border border-secondary rounded row mx-2">
                    <div class="col-md-12">
                        <label class="form-label d-flex gap-1 align-items-center">
                            Seleccione una tabla
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="conditions-selector" class="form-label">Activar Condicionales</label>
                    <select class="form-select" id="conditions-selector" name="conditions">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="relationships-selector" class="form-label">Activar Relaciones</label>
                    <select class="form-select" id="relationships-selector" name="relationships">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
            </div>
            <div class="d-none flex-column" id="conditions-container">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Condiciones</h5><button type="button" class="btn btn-primary" id="add-condition-button">Añadir Condición</button>
                </div>
                <div class="row" id="conditions-container-1">
                    <div class="col-md-6 mb-3">
                        <label for="condition-column-selector" class="form-label">Campo</label>
                        <select class="form-select condition-column-selectors" id="condition-column-selector" name="condition_column[]" autocomplete="off">
                            <option value="">Seleccione una columna</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="condition-operator-selector" class="form-label">Operador</label>
                        <select class="form-select" id="condition-operator-selector" name="condition_operator[]">
                            <option value="">Seleccione un operador</option>
                            <option value="=">Igual</option>
                            <option value="!=">Diferente</option>
                            <option value=">">Mayor que</option>
                            <option value="<">Menor que</option>
                            <option value=">=">Mayor o igual que</option>
                            <option value="<=">Menor o igual que</option>
                            <option value="LIKE">Igual a (LIKE)</option>
                            <option value="NOT LIKE">Diferente a (LIKE)</option>
                            <option value="IN">En (IN)</option>
                            <option value="NOT IN">No en (IN)</option>
                            <option value="BETWEEN">Entre (BETWEEN)</option>
                            <option value="NOT BETWEEN">No entre (BETWEEN)</option>
                            <option value="IS NULL">Es nulo (IS NULL)</option>
                            <option value="IS NOT NULL">No es nulo (IS NOT NULL)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="condition-value" class="form-label">Valor</label>
                        <input type="text" class="form-control" id="condition-value" name="condition_value[]">
                    </div>
                </div>
            </div>
            {{-- <div class="flex-column" id="relationships-container">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Relaciones</h5><button type="button" class="btn btn-primary" id="add-relationship-button">Añadir Relación</button>
                </div>
                <div class="row" id="relationships-container-1">
                    <div class="col-md-6 mb-3">
                        <label for="relationship-table-selector" class="form-label">Tabla</label>
                        <select class="form-select relationship-table-selectors" id="relationship-table-selector" name="relationship_table[]" autocomplete="off">
                            <option value="">Seleccione una tabla</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-12 mb-3">
                <button type="button" id="submit-button" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </section>
    <section class="container mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h5>Resultados</h5>
            <button type="button" class="btn btn-primary" id="btn-show-info">Mostrar Información</button>
            <button type="button" class="btn btn-primary" id="btn-load-chart">Cargar Gráfico</button>
        </div>
        <div id="results-container" class="row mt-2">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr id="table-head-buttons">

                        </tr>
                        <tr id="table-head">
                            
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal guardar datos -->
    <div class="modal fade" id="modal_save_data" tabindex="-1" aria-labelledby="modal_save_dataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_save_dataLabel">Guardar Datos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 60vh; overflow: scroll;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data-type-selector" class="form-label">Guardar columna <strong id="label-data-name"></strong> como:</label>
                            <select class="form-select" id="data-type-selector" name="data_type" autocomplete="off">
                                <option value="labels">Etiquetas</option>
                                <option value="values">Valores</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 d-none" id="div-data-name">
                            <label for="data-name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="data-name" name="data_name">
                        </div>
                        <div class="col-md-12">
                            <h5>Valores Actuales</h5>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr id="tr-labels">
                                        <th>
                                            <button type="button" class="btn btn-danger" id="btn-resset-label">X</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="modal-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-save-data">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal cargar grafico-->
    <div class="modal fade" id="modal_load_grafic" tabindex="-1" aria-labelledby="modal_load_graficModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal_load_graficModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <canvas id="chart"></canvas>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btn-download-canvas">Guardar Gráfico</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal configurar grafico-->
    <div class="modal fade" id="modal_config_grafic" tabindex="-1" aria-labelledby="modal_config_graficModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal_config_graficModalLabel">Configurar Gráfico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="chart-type-selector" class="form-label">Tipo de Gráfico</label>
                            <select class="form-select" id="chart-type-selector" name="chart_type">
                                <option value="bar">Barra</option>
                                <option value="line">Linea</option>
                                <option value="pie">Pastel</option>
                                <option value="doughnut">Dona</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="chart-title" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="chart-title" name="chart_title">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="chart-background-color" class="form-label">Color de Fondo</label>
                            <input type="color" class="form-control" id="chart-background-color" name="chart_background_color">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="chart-border-color" class="form-label">Color del Borde de los Elementos</label>
                            <input type="color" class="form-control" id="chart-border-color" name="chart_border_color">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="chart-font-color" class="form-label">Color de la fuente</label>
                            <input type="color" class="form-control" id="chart-font-color" name="chart_font_color">
                        </div>
                        <div id="div-config-data" class="row">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="load-chart-button">Cargar Gráfico</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal mostrar info -->
    <div class="modal fade" id="modal_info" tabindex="-1" aria-labelledby="modal_infoLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_infoLabel">Información</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr id="table-info-labels" class="table-info-row">
                                    </tr>
                                </thead>
                                <tbody id="table-info-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/request.js"></script>
    <script src="../js/estadisticas/data.js"></script>
    <script src="../js/estadisticas/index.js"></script>
</html>