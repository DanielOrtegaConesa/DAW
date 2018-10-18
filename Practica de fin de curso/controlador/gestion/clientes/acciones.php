<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "add":
        $dni = $_REQUEST["dni"];
        $razonSocial = $_REQUEST["razonSocial"];
        $domicilioSocial = $_REQUEST["domicilioSocial"];
        $ciudad = $_REQUEST["ciudad"];
        $email = $_REQUEST["email"];
        $telefono = $_REQUEST["telefono"];
        $nick = $_REQUEST["nick"];
        $pass = $_REQUEST["pass"];


        $ad = arrayDatosPDO("nick", $nick);
        $retornar ["correcto"] = true;

        if (!existeregistroPrepPDO($conexion, "clientes", $ad) && !existeregistroPrepPDO($conexion, "solicitudes", $ad)) {
            if (!validarDni($dni)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "DNI no valido";
            }

            if (!esinf($razonSocial, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Razon social debe tener entre 1 y 50 caracteres";
            }

            if (!esinf($domicilioSocial, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Domicilio social debe tener entre 1 y 50 caracteres";
            }

            if (!esinf($ciudad, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Debe tener entre 1 y 50 caracteres";
            }

            if (!esinf($email, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Email debe tener entre 1 y 50 caracteres";
            }


            if (strlen($telefono) == 9) {
                if (!esnumero($telefono)) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Telefono debe ser numerico";
                }
            } else {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Telefono debe tener 9 numeros";
            }

            if (!esinf($nick, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Nick debe tener entre 1 y 50 caracteres";
            }

            if (!esinf($pass, 50)) {
                $retornar ["correcto"] = false;
                $retornar["errores"][] = "Contraseña debe tener entre 1 y 50 caracteres";
            }

        } else {
            $retornar ["correcto"] = false;
            $retornar["errores"][] = "El usuario ya existe";
        }

        if ($retornar["correcto"]) {
            $arrayDatos = arrayDatosPDO("dni,,razonSocial,,domicilioSocial,,ciudad,,email,,telefono,,nick,,pass,,activo", "$dni,,$razonSocial,,$domicilioSocial,, $ciudad,,$email,,$telefono,,$nick,,$pass,,1");
            insertPrepPDO($conexion, "clientes", $arrayDatos);
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        breaK;
    case "editar":
        $nick = $_REQUEST["nick"];
        $condicion = arrayDatosPDO("nick,,activo", $nick . ",,1");
        $r = selectPrepPDO($conexion, "*", "clientes", $condicion);
        $r = $r[0];
        echo json_encode($r, JSON_UNESCAPED_UNICODE);
        break;
    case "actualizar":
        /*    $nick = "dani";
            $dni = "dani";
            $razonSocial = "dani";
            $domicilioSocial = "dani";
            $ciudad = "dani";
            $email = "dani";
            $telefono = "dani";
            $nick = "dani";
            $pass  = "dani";
        */

        $cod = $_REQUEST["codCliente"];
        $nick = $_REQUEST["nick"];
        $dni = $_REQUEST["dni"];
        $razonSocial = $_REQUEST["razonSocial"];
        $domicilioSocial = $_REQUEST["domicilioSocial"];
        $ciudad = $_REQUEST["ciudad"];
        $email = $_REQUEST["email"];
        $telefono = $_REQUEST["telefono"];
        $nick = $_REQUEST["nick"];
        $pass = $_REQUEST["pass"];


        $ad = arrayDatosPDO("codCliente", $cod);
        $retornar ["correcto"] = true;

        if (existeregistroPrepPDO($conexion, "clientes", $ad)) {


            if ($dni != "") {
                if (validarDni($dni)) {
                    $adatos = arrayDatosPDO("dni", $dni);
                    updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
                } else {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "DNI no valido";
                }
            }

            if (esinf($razonSocial, 50)) {
                $adatos = arrayDatosPDO("razonSocial", $razonSocial);

                updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);

            } else {
                if (strlen($razonSocial) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Razon social excede el tamaño maximo permitido";
                }
            }
            if (esinf($domicilioSocial, 50)) {
                $adatos = arrayDatosPDO("domicilioSocial", $domicilioSocial);
                updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
            } else {
                if (strlen($domicilioSocial) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Domicilio social excede el tamaño maximo permitido";
                }
            }

            if (esinf($ciudad, 50)) {
                $adatos = arrayDatosPDO("ciudad", $ciudad);
                updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
            } else {
                if (strlen($ciudad) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Ciudad excede el tamaño maximo permitido";
                }
            }

            if (esinf($email, 50)) {
                $adatos = arrayDatosPDO("email", $email);
                updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
            } else {
                if (strlen($email) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Email excede el tamaño maximo permitido";
                }
            }

            if (esinf($telefono, 9)) {
                if (strlen($telefono) == 9) {
                    if (esnumero($telefono)) {
                        $adatos = arrayDatosPDO("telefono", $telefono);
                        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
                    } else {
                        $retornar ["correcto"] = false;
                        $retornar["errores"][] = "Telefono debe ser numerico";
                    }
                } else {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Telefono debe tener 9 numeros";
                }
            } else {
                if (strlen($telefono) > 9) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Telefono debe tener 9 numeros";
                }
            }

            if (esinf($nick, 50)) {
                $sunick = selectPDO($conexion, "nick", "clientes", "codCliente='$cod'");
                $sunick = $sunick[0]["nick"];
                if ($sunick != $nick) {
                    $adatos = arrayDatosPDO("nick", "$nick");
                    if (!existeregistroPrepPDO($conexion, "clientes", $adatos) && !existeregistroPrepPDO($conexion, "solicitudes", $adatos)) {
                        $adatos = arrayDatosPDO("nick", $nick);
                        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
                    } else {
                        $retornar ["correcto"] = false;
                        $retornar["errores"][] = "El nick ya esta en uso";
                    }
                }
            } else {
                if (strlen($nick) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Nick excede el tamaño maximo permitido";
                }
            }

            if (esinf($pass, 50)) {
                $adatos = arrayDatosPDO("pass", $pass);
                updatePrepPDO($conexion, "clientes", "codCliente='$cod'"    , $adatos);
            } else {
                if (strlen($pass) > 50) {
                    $retornar ["correcto"] = false;
                    $retornar["errores"][] = "Contraseña excede el tamaño maximo permitido";
                }
            }
            echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "baja":
        $nick = $_REQUEST["nick"];
        $ad = arrayDatosPDO("nick", $nick);
        if (existeregistroPrepPDO($conexion, "clientes", $ad)) {
            $ad2 = arrayDatosPDO("activo", "0");
            updatePrepPDO($conexion, "clientes", "nick = '" . $_REQUEST["nick"] . "'", $ad2);
        }
        break;
    case "seleccionar":
        $nick = $_REQUEST["nick"];
        session_start();
        $_SESSION["cliente"] = new Usuario("$nick");
        $_SESSION["cliente"]->cargar($conexion);
        breaK;
}
