<?php
    include("./cabecera.php"); 
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-7 col-md-4">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
    

                        <!-- Form Example -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Nuevo proyecto</h1>
                                    </div>
                                    <form method='post' class="user" action='controlador.php'>
                                        <div class="form-group">
                                            <input type="hidden" name="nuevo" class="form-control form-control-user"
                                                value="nuevo">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input type="text" name="nombre" class="form-control form-control-user"
                                                id="nombre" placeholder="Introduce el nombre...">
                                        </div>
                                        <div class="form-group">
                                            <label for="fechaInicio">Fecha de inicio:</label>
                                            <input type="date" name="fechaInicio" class="form-control form-control-user"
                                                id="fechaInicio" placeholder="DD/MM/YYYY">
                                        </div>
                                        <div class="form-group">
                                            <label for="fechaFinPrevista">Fecha de fin prevista:</label>
                                            <input type="date" name="fechaFinPrevista" class="form-control form-control-user"
                                                id="fechaFinPrevista" placeholder="DD/MM/YYYY">
                                        </div>
                                        <div class="form-group">
                                            <label for="diasTranscurridos">Dias transcurridos:</label>
                                            <input type="text" name="diasTranscurridos" class="form-control form-control-user"
                                                id="diasTranscurridos" placeholder="Días transcurridos...">
                                        </div>
                                        <div class="form-group">
                                            <label for="porcentajeCompletado">Porcentaje completado:</label>
                                            <input type="text" name="porcentajeCompletado" class="form-control form-control-user"
                                                id="porcentajeCompletado" placeholder="Porcentaje completado...">
                                        </div>
                                        <div class="form-group">
                                            <label for="importancia">Importancia:</label>
                                            <input type="text" name="importancia" class="form-control form-control-user"
                                                id="importancia" placeholder="Importancia...">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block">
                                            Añadir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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