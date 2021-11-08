<?php 

//Esta funcion muestra el nombre de la pagina actual, ES IMPRESCINDIBLE COPIAR Y PEGAR ESTE TROZO DE CODIGO AL INICIO DE CADA PAGINA FUTURA QUE SE CREE *<<< PAGINAS QUE SE ENCUENTREN DIRECTAMENTE EN LA RAIZ DEL PROYECTO, ES DECIR, QUE NO ESTAN EN NINGUNA CARPETA:ejemplo de archivos que se encuentran en la raiz del proyecto: inicio.php, login.php, crearPaciente.php... >>>>>**, y DEBE IR ANTES DEL HEADER.PHP . Esta funcion será llamada en el header en el titulo (en el title de la pagina)
function paginaActual(){
//recogemos el nombre del archivo actual
 $nombreDelArchivoActual = __FILE__ ;
 $nombrePagina = ucfirst(basename($nombreDelArchivoActual,".php"));
    //imprime el nombre del archivo actual
    return $nombrePagina;
}

?>

<!-- Incluyendo el header de la pagina  -->
<?php include("plantillas/header.php"); ?>

<!--CONTENIDO DE LA PAGINA -->
<section class="panelControl">
    <div class="container">
        <div class="row">
            <div class="col-12 titulo-panel">
                <h2 class="card-title">Panel de administración</h2>
                <p>Consulte las estadisticas del centro de salud</p>
            </div>
            <div class="col-md-12 ">
                <div class="row ">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-cherry">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Nuevos pacientes</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            3,243
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-blue-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Consultas</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            15.07k
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Total personal</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            578
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>10% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-orange-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Total altas</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            $11.61k
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="row">
            <div class="col-12">
                <div class="card  custom-card">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Total Shipments</h5>
                        <h2 class="card-title">Performance</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                        <label class="btn btn-sm btn-primary btn-simple active" id="0">
                            <input type="radio" name="options" checked>
                            <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                            <span class="d-block d-sm-none">
                            <i class="tim-icons icon-single-02"></i>
                            </span>
                        </label>
                        <label class="btn btn-sm btn-primary btn-simple" id="1">
                            <input type="radio" class="d-none d-sm-none" name="options">
                            <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                            <span class="d-block d-sm-none">
                            <i class="tim-icons icon-gift-2"></i>
                            </span>
                        </label>
                        <label class="btn btn-sm btn-primary btn-simple" id="2">
                            <input type="radio" class="d-none" name="options">
                            <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                            <span class="d-block d-sm-none">
                            <i class="tim-icons icon-tap-02"></i>
                            </span>
                        </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chartBig1"></canvas>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4">
                <div class="card  custom-card">
                <div class="card-header">
                    <h5 class="card-category">Total Shipments</h5>
                    <h3 class="card-title"><i class="fas fa-users text-primary"></i> 763,215</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card  custom-card">
                <div class="card-header">
                    <h5 class="card-category">Daily Sales</h5>
                    <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="CountryChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card  custom-card">
                <div class="card-header">
                    <h5 class="card-category">Completed Tasks</h5>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                <div class="card-header">
                    <h4 class="card-title"> Ultimas consultas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table tablesorter " id="">
                        <thead class="text-primary">
                        <tr>
                            <th>
                            Name
                            </th>
                            <th>
                            Country
                            </th>
                            <th>
                            City
                            </th>
                            <th class="text-center">
                            Salary
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                            Dakota Rice
                            </td>
                            <td>
                            Niger
                            </td>
                            <td>
                            Oud-Turnhout
                            </td>
                            <td class="text-center">
                            $36,738
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- FIN CONTENDIO DE LA PAGINA -->
<!-- Incluyendo el footer de la pagina  -->
<?php include('plantillas/footer.php'); ?>