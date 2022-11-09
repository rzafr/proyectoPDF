<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require './vendor/autoload.php';

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

        <script src="styles/chart.js/Chart.min.js"></script>
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

    function crearPDF($proyectos) {
        
        
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor('Javi Profe');
        $pdf->setTitle('Proyectos de mi empresa');
        $pdf->setSubject('Proyectos');
        $pdf->setKeywords('PHP, PDF, proyectos');

        // set default header data
        //$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->setFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = "
        <h1>PROYECTOS</h1>
        <i>Todos los proyectos de mi empresa</i><br><br>";
        $html .= "<table border='1'>";
        $html .= "<tr><td>Nombre</td><td>Fecha inicio</td><td>Fecha fin</td><td>Dias transcurridos</td>
                <td>Completado</td><td>Importancia</td></tr>";

        foreach($proyectos as $proyecto) {
            $html .= "<tr>";
            $html .= "<td>".$proyecto['nombre']."</td>";
            $html .= "<td>".$proyecto['fechaInicio']."</td>";
            $html .= "<td>".$proyecto['fechaFinPrevista']."</td>";
            $html .= "<td>".$proyecto['diasTranscurridos']."</td>";
            $html .= "<td>".$proyecto['porcentajeCompletado']."</td>";
            $html .= "<td>".$proyecto['importancia']."</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        echo "Generando ...";

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $flujo = $pdf->Output('ejemplo.pdf', 'S');
        file_put_contents("ejemplo.pdf", $flujo);

        echo "Generado.";
        //============================================================+
        // END OF FILE
        //============================================================+
    }

    function enviarPDF() {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $pass = 'fbgoulflxpenfvky';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'em4il45pam@gmail.com';                     //SMTP username
            $mail->Password   = $pass;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('em4il45pam@gmail.com', 'Javier');
            $mail->addAddress($_SESSION['usuario'], 'ProfeJJ');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('./ejemplo.pdf', 'ejemplo.pdf');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Correo de mi página de proyectos';
            $mail->Body    = 'Este el cuerpo del mensaje <b>ojo, viene con adjunto!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>