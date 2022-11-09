<?php session_start(); ?>
<?php

    include('./lib.php');

    // Comprobamos si se ha mandado algo por POST
    if ($_POST) {
        // Comprobamos si se ha enviado algo por el formulario de login
        if (isset($_POST['login'])) {
            // Comprobamos la password
            if (isset($_POST['password'])) {
                // Filtramos la password
                filtrado($_POST['password']);
                // Controlamos que la password tenga mas de 8 caracteres
                if (strlen($_POST['password']) < 9) {
                    // Si la password no cumple la condicion volvemos a login.php informando del error
                    header("Location: ./login.php?mensaje=passwordCorta");
                // Controlamos que la password tenga al menos una mayuscula
                } else if (strtolower($_POST['password']) == $_POST['password']) {
                    // Si la password no cumple la condicion volvemos a login.php informando del error
                    header("Location: ./login.php?mensaje=passwordMayuscula");
                } else {
                    // Comprobamos el email
                    if ((isset($_POST['email'])) && ($_POST['email'] != null)) {
                        // Filtramos el email
                        filtrado($_POST['email']);
                        // Metemos el email en la sesion
                        $_SESSION['usuario'] = $_POST['email'];
                        // Redirige a proyectos.php
                        header("Location: ./proyectos.php");
                    } else {
                        header("Location: ./login.php?mensaje=introduceEmail"); 
                    }
                }
            }
        }

        // Comprobamos si se ha enviado algo por el formulario de proyecto nuevo
        if (isset($_POST['nuevo'])) {
            if (isset($_SESSION['proyectos'])) {
                if (empty($_SESSION['proyectos'])) {
                    $idNuevoProyecto = 1;
                } else {
                    $idNuevoProyecto = max(array_column($_SESSION['proyectos'], "id")) + 1;
                }
                
            } else {
                $idNuevoProyecto = 1;
            }

            $nuevoProyecto = array("id" => $idNuevoProyecto, 
                                    "nombre" => $_POST['nombre'], 
                                    "fechaInicio" => $_POST['fechaInicio'],          
                                    "fechaFinPrevista" => $_POST['fechaFinPrevista'],
                                    "diasTranscurridos" => $_POST['diasTranscurridos'], 
                                    "porcentajeCompletado" => $_POST['porcentajeCompletado'], 
                                    "importancia" => $_POST['importancia']);
            // Creamos una fila nueva en el array de sesiOn de proyectos 
            array_push($_SESSION['proyectos'], $nuevoProyecto);
            header("Location: ./proyectos.php");
        }
    }

    // Comprobamos si se ha mandado algo por GET
    if ($_GET) {
        if (isset($_GET['accion'])) {
            // Eliminamos proyectos por id
            if (strcmp($_GET['accion'], "eliminar") == 0) {
                $proyectosNuevo = array();
                foreach ($_SESSION['proyectos'] as $proyecto) {
                    if ($proyecto['id'] != $_GET['id'])
                        array_push($proyectosNuevo, $proyecto);
                }
                $_SESSION['proyectos'] = $proyectosNuevo;
                header("Location: ./proyectos.php");
            }

            // Eliminamos todo
            if (strcmp($_GET['accion'], "eliminarTodo") == 0) {
                $_SESSION['proyectos'] = array();
                header("Location: ./proyectos.php");
            }
        }
    }

?>

