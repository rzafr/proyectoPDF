<?php session_start(); ?>
<?php
    include("./lib.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proyectos PHP</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Proyectos <sup>PHP</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="proyectos.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Proyectos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">OPCIONES:</h6>
                        <!-- Se agrega data-toggle y data-target para el modal -->
                        <a class="collapse-item" data-toggle="modal" data-target="#nuevo" href="#">Añadir proyecto</a>
                            
                        <a class="collapse-item" href="controlador.php?accion=eliminarTodo">Eliminar todos</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                echo '<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$_SESSION["usuario"].'</span>';
                                ?>
                                <img class="img-profile rounded-circle"
                                   src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

<!-- Formulario modal -->
<div class='modal fade' id='nuevo'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='modal-title'>
                    <h1 class='h4 text-gray-900 mb-4'>Nuevo proyecto</h1>
                </div>            
            </div>
            <div class='modal-body'>
                <div class='container-fluid'>
                    <form method='post' class='user' action='controlador.php'>
                        <div class='form-group'>
                            <input type='hidden' name='nuevo' class='form-control form-control-user'
                                value='nuevo'>
                        </div>
                        <div class='form-group'>
                            <label for='nombre'>Nombre:</label>
                            <input type='text' name='nombre' class='form-control form-control-user'
                                id='nombre' placeholder='Introduce el nombre...'>
                        </div>
                        <div class='form-group'>
                            <label for='fechaInicio'>Fecha de inicio:</label>
                            <input type='date' name='fechaInicio' class='form-control form-control-user'
                                id='fechaInicio' placeholder='DD/MM/YYYY'>
                        </div>
                        <div class='form-group'>
                            <label for='fechaFinPrevista'>Fecha de fin prevista:</label>
                            <input type='date' name='fechaFinPrevista' class='form-control form-control-user'
                                id='fechaFinPrevista' placeholder='DD/MM/YYYY'>
                        </div>
                        <div class='form-group'>
                            <label for='diasTranscurridos'>Dias transcurridos:</label>
                            <input type='text' name='diasTranscurridos' class='form-control form-control-user'
                                id='diasTranscurridos' placeholder='Días transcurridos...'>
                        </div>
                        <div class='form-group'>
                            <label for='porcentajeCompletado'>Porcentaje completado:</label>
                            <input type='text' name='porcentajeCompletado' class='form-control form-control-user'
                                id='porcentajeCompletado' placeholder='Porcentaje completado...'>
                        </div>
                        <div class='form-group'>
                            <label for='importancia'>Importancia:</label>
                            <input type='text' name='importancia' class='form-control form-control-user'
                                id='importancia' placeholder='Importancia...'>
                        </div>
                        <button type='submit' class='btn btn-success btn-user btn-block'>
                            Añadir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>