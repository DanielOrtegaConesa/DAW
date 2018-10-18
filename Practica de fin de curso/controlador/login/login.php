<?php
include_once "../php/funciones.php";
include_once "../../modelo/funciones_BBDD_PDO.php";
include_once "../../modelo/autoload.php";


# Verify captcha
$captcha = json_decode(
    file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $_POST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR'])
);
if ($captcha->success) {
    $nick = $_REQUEST["nick"];
    $pass = $_REQUEST["pass"];
    $tipo = $_REQUEST["tipo"];

    $retornar["correcto"] = false;


    if (!esinf($nick, 50)) $retornar["errores"][] = "Nick supera el tamaño maximo (50), o esta vacio";
    if (!esinf($pass, 50)) $retornar["errores"][] = "Contraseña supera el tamaño maximo (50), o esta vacio";

    if (!isset($retornar["errores"])) {
        $arrayDatos = arrayDatosPDO("nick,,pass", "$nick,,$pass");

        if ($tipo == "gestor") {
            $conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);
            if (existeregistroPrepPDO($conexion, "usuariosGestion", $arrayDatos)) {
                session_start();
                $_SESSION["usuario"] = new UsuarioGestion($nick, $pass);
                $_SESSION["usuario"]->cargar($conexion);

                $_SESSION["usuario"]->setTipo("gestor");
                $codUsuarioGestion = $_SESSION["usuario"]->getCodUsuarioGestion();
                $fact = fechaActualMysql();
                $arrayDatos = arrayDatosPDO("codUsuarioGestion,,fechaHoraAcceso", "$codUsuarioGestion,,$fact");
                insertPrepPDO($conexion, "accesos", $arrayDatos);
                $retornar["correcto"] = true;

            } else {
                $retornar["correcto"] = false;
                $retornar["errores"][] = "La combinacion usuario / contraseña no existe";
            }
        }
        if ($tipo == "cliente") {
            $conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

            if (existeregistroPrepPDO($conexion, "clientes", $arrayDatos)) {
                session_start();
                $_SESSION["usuario"] = new Usuario($nick, $pass);
                $_SESSION["usuario"]->cargar($conexion);

                if ($tipo == "cliente") {
                    if ($_SESSION["usuario"]->getActivo() == 1) {
                        $_SESSION["usuario"]->setTipo("cliente");
                        $retornar["correcto"] = true;
                    } else {
                        $retornar["correcto"] = false;
                        $retornar["errores"][] = "El usuario esta desactivado";
                    }
                }
                if ($retornar["correcto"] == false) {
                    $_SESSION = [];
                    unset($_SESSION);
                    session_destroy();
                }

            } else {
                $retornar["correcto"] = false;
                $retornar["errores"][] = "La combinacion usuario / contraseña no existe";
            }
        }
    }
}else{
    $retornar["correcto"] = false;
    $retornar["errores"][] = "Te hemos detectado como un robot";
}

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
?>