<?php

    // Limpia los input de los formularios
    function filtrado($datos) {
        $datos = trim($datos); // Elimina espacios antes y despues de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        return $datos;
    }

    // Pinta la tabla de proyectos
    function pintarTablaProyectos($pro) {
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin prevista</th>
                        <th>Dias transcurridos</th>
                        <th>Porcentaje</th>
                        <th>Importancia</th>
                        <th colspan='2'>Acciones</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tfoot>";
                echo "<tr>";
                    echo "<th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin prevista</th>
                        <th>Dias transcurridos</th>
                        <th>Porcentaje</th>
                        <th>Importancia</th>
                        <th colspan='2'>Acciones</th>";
                echo "</tr>";
            echo "</tfoot>";
            echo "<tbody>";
                foreach($pro as $proyecto) {
                    echo "<tr>";
                        echo "<td>".$proyecto['nombre']."</td>
                            <td>".$proyecto['fechaInicio']."</td>
                            <td>".$proyecto['fechaFinPrevista']."</td>
                            <td>".$proyecto['diasTranscurridos']."</td>
                            <td>".$proyecto['porcentajeCompletado']."</td>
                            <td>".$proyecto['importancia']."</td>
                            <td>
                                <button>
                                    <a href='./controlador.php?accion=eliminar&id=".$proyecto['id']."'>
                                        Eliminar
                                    </a>
                                </button>
                            </td>
                            <td>
                                <button>
                                    <a href='./verProyecto.php?accion=ver&id=".$proyecto['id']."'>
                                        Detalle
                                    </a>
                                </button>
                            </td>";
                    echo "</tr>";
                }
            echo "</tbody>";
        echo "</table>";
    }

    function pintarGrafico($proyectoVer) {
?>

        <script src="vendor/chart.js/Chart.min.js"></script>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Pie Chart Example
            <?php
                echo "var completado = " .$proyectoVer['porcentajeCompletado']. ";"; 
            ?>
            var ctx = document.getElementById("otroPieChart");
            var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["No completado", "Completado"],
                datasets: [{
                data: [100-completado, completado],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                },
                legend: {
                display: false
                },
                cutoutPercentage: 80,
            },
            });
        </script>

<?php
    }
?>