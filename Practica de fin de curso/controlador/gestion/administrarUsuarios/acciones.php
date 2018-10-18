<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];
$nick = $_REQUEST["nick"];
$condicion = arrayDatosPDO("nick", $nick);

switch ($accion) {
    case "rechazar":
        $usuario = selectPrepPDO($conexion, "email", "solicitudes", $condicion);
        $usuario = $usuario[0];
        if (borrarPrepPDO($conexion, "solicitudes", $condicion)) {
            // mail
            $destinatario = $usuario["email"];
            $asunto = "Resolucion de solicitud en DaniPhone";
            $cuerpo = ' <html> <head> <title>Resolucion de solicitud en DaniPhone</title> </head> 
                                <body> 
                                    <h1>Hola!</h1> 
                                    <p>Le comunicamos que ha sido rechazado en daniPhone, puede volver a realizar una solicitud haciendo click <a href="www.danielortegaconesa.com?page=registro">Aqui. </a>
                                     Si el anterior enlace no funciona copie y pege esta direccion en su navegador www.danielortegaconesa.com?page=registro</p> 
                                </body> 
                        </html>';

//para el envío en formato HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
//dirección del remitente
            $headers .= "From: Daniel Ortega  <admin@danielortegaconesa.com>\r\n";

            mail($destinatario, $asunto, $cuerpo, $headers);
        }
        break;
    case
    "aceptar":
        $correcto = true;
        $conexion->beginTransaction();

        $usuario = selectPrepPDO($conexion, "*", "solicitudes", $condicion);
        $usuario = $usuario[0];
        $adatos = arrayDatosPDO(
            "dni,,razonSocial,,domicilioSocial,,ciudad,,email,,telefono,,nick,,pass,,activo",
            $usuario["dni"] . ",," . $usuario["razonSocial"] . ",," . $usuario["domicilioSocial"] . ",," . $usuario["ciudad"] . ",," . $usuario["email"] . ",," . $usuario["telefono"] . ",," . $usuario["nick"] . ",," . $usuario["pass"] . ",,1");
        if (!insertPrepPDO($conexion, "clientes", $adatos)) $correcto = false;
        if (!borrarPrepPDO($conexion, "solicitudes", $condicion)) $correcto = false;

        if ($correcto) {
            $conexion->commit();
            // mail
            $destinatario = $usuario["email"];
            $asunto = "Resolucion de solicitud en DaniPhone";
            $cuerpo = ' <html> <head> <title>Resolucion de solicitud en DaniPhone</title> </head> 
                                <body> 
                                    <h1>Hola!</h1> 
                                    <p> <b>Le comunicamos que ha sido aceptado en daniPhone, puede acceder a su cuenta haciendo click <a href="www.danielortegaconesa.com">Aqui</a><b>
                                    </p> 
                                </body> 
                        </html>';

//para el envío en formato HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
//dirección del remitente
            $headers .= "From: Daniel Ortega  <admin@danielortegaconesa.com>\r\n";

            mail($destinatario, $asunto, $cuerpo, $headers);
        } else $conexion->rollBack();
        break;
}