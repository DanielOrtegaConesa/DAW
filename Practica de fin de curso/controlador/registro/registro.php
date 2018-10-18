<?php
include_once "../php/funciones.php";
include_once "../../modelo/funciones_BBDD_PDO.php";

# Verify captcha
$captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $_POST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
if ($captcha->success) {
    $dni = $_REQUEST["dni"];
    $razonSocial = $_REQUEST["razonSocial"];
    $domicilioSocial = $_REQUEST["domicilioSocial"];
    $ciudad = $_REQUEST["ciudad"];
    $email = $_REQUEST["email"];
    $telefono = $_REQUEST["telefono"];
    $nick = $_REQUEST["nick"];
    $pass = $_REQUEST["pass"];

    $retornar["correcto"] = false;

    if (!validarDni($dni)) $retornar["errores"][] = "DNI no valido";
    if (!esinf($razonSocial, 50)) $retornar["errores"][] = "Razon social supera el tamaño maximo (50), o esta vacio";
    if (!esinf($domicilioSocial, 50)) $retornar["errores"][] = "Domicilio social supera el tamaño maximo (50), o esta vacio";
    if (!esinf($ciudad, 50)) $retornar["errores"][] = "Ciudad supera el tamaño maximo (50), o esta vacio";
    if (!esinf($email, 50)) $retornar["errores"][] = "Email supera el tamaño maximo (50), o esta vacio";
    if (!esinf($telefono, 9)) $retornar["errores"][] = "Telefono supera el tamaño maximo (9), o esta vacio";
    if (!esnumero($telefono)) $retornar["errores"][] = "Telefono debe ser numerico";
    if (!esinf($nick, 50)) $retornar["errores"][] = "Nick supera el tamaño maximo (50), o esta vacio";
    if (!esinf($pass, 50)) $retornar["errores"][] = "Contraseña supera el tamaño maximo (50), o esta vacio";

    if (!isset($retornar["errores"])) {
        $conexion = conectarPDO(SERVIDOR, DB, USUARIOL, PASSWORDL);

        $arrayDatos = arrayDatosPDO("nick", "$nick");

        if (!existeregistroPrepPDO($conexion, "clientes", $arrayDatos)) {

            if (!existeregistroPrepPDO($conexion, "solicitudes", $arrayDatos)) {
                $arrayDatos = arrayDatosPDO("dni,,razonSocial,,domicilioSocial,,ciudad,,email,,telefono,,nick,,pass", "$dni,,$razonSocial,,$domicilioSocial,, $ciudad,,$email,,$telefono,,$nick,,$pass");
                if (insertPrepPDO($conexion, "solicitudes", $arrayDatos)) $retornar["correcto"] = true;
            } else {
                $retornar["correcto"] = false;
                $retornar["errores"][] = "Ya hay una solicitud con ese nick";
            }

        } else {
            $retornar["correcto"] = false;
            $retornar["errores"][] = "Ya hay un cliente con ese nick";
        }
    }

} else {
    $retornar["correcto"] = false;
    $retornar["errores"][] = "Te hemos detectado como un robot";
}

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);

?>