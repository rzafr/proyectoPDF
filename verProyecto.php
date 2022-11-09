<?php
    include("./cabecera.php");
    //include("./lib.php"); 
?>

<?php
    if ($_GET) {
        if (isset($_GET['accion'])) {
            if (strcmp($_GET['accion'], "ver") == 0) {
                $proyectoVer = array();
                // Sacamos el proyecto a ver comparando los id
                foreach ($_SESSION['proyectos'] as $proyecto) {
                    if ($proyecto['id'] == $_GET['id'])
                        $proyectoVer = $proyecto;
                }
            }
        }
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php
        echo "<h1 class='h3 mb-0 text-gray-800'>".$proyectoVer['nombre']."</h1>";
    ?>
</div>

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Fecha de inicio
                        </div>
                        <?php
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$proyectoVer['fechaInicio']."</div>";
                        ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Fecha fin prevista
                        </div>
                        <?php
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$proyectoVer['fechaFinPrevista']."</div>";
                        ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Dias transcurridos
                        </div>
                        <?php
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$proyectoVer['diasTranscurridos']."</div>";
                        ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Importancia
                        </div>
                        <?php
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$proyectoVer['importancia']."</div>";
                        ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

<!-- Donut Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Porcentaje completado</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4">
                <canvas id="otroPieChart"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<?php

    // Pintamos el gráfico circular
    pintarGrafico($proyectoVer);

    include("./pie.php"); 
?>