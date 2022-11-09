<?php
    include("./cabecera.php");
    //include('./lib.php');
?>

                <?php
               
                    // Si no se ha hecho aun
                    if (!isset($_SESSION['proyectos'])) {
                        
                        $proyectos = array(
                            array("id" => 1, "nombre" => "Formacion continua", "fechaInicio" => "2022-10-15", "fechaFinPrevista" => "2022-10-25", "diasTranscurridos" => 6, "porcentajeCompletado" => 60, "importancia" => 1),
                            array("id" => 2, "nombre" => "Eficiencia energetica", "fechaInicio" => "2022-08-21", "fechaFinPrevista" => "2023-02-21", "diasTranscurridos" => 60, "porcentajeCompletado" => 40, "importancia" => 2),
                            array("id" => 3, "nombre" => "Renovacion equipos", "fechaInicio" => "2022-10-01", "fechaFinPrevista" => "2022-11-11", "diasTranscurridos" => 20, "porcentajeCompletado" => 50, "importancia" => 4),
                            array("id" => 4, "nombre" => "Optimizacion de procesos", "fechaInicio" => "2022-10-20", "fechaFinPrevista" => "2023-03-25", "diasTranscurridos" => 10, "porcentajeCompletado" => 20, "importancia" => 1),
                            array("id" => 5, "nombre" => "Implementacion aplicacion", "fechaInicio" => "2022-11-21", "fechaFinPrevista" => "2022-12-21", "diasTranscurridos" => 0, "porcentajeCompletado" => 0, "importancia" => 2),
                            array("id" => 6, "nombre" => "Revision objetivos", "fechaInicio" => "2022-08-01", "fechaFinPrevista" => "2022-11-30", "diasTranscurridos" => 40, "porcentajeCompletado" => 70, "importancia" => 3)
                            );   

                        // Metemos en la sesion los proyectos
                        $_SESSION['proyectos'] = $proyectos;
                    }
                        
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Proyectos</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Proyectos de la sesion</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                
                                <?php
                                    // Pintamos la tabla de proyectos
                                    pintarTablaProyectos($_SESSION['proyectos']);
                                ?>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    include("./pie.php"); 
?>