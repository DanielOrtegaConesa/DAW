<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminar":
        $codPedido = $_REQUEST["codPedido"];
        $adatos = arrayDatosPDO("codPedido", "$codPedido");
        if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", $adatos)) {

            $conexion->beginTransaction();
            $correcto = true;
            if (!borrarPrepPDO($conexion, "lineasPedidos", $adatos)) $correcto = false;
            if (!borrarPrepPDO($conexion, "pedidos", $adatos)) $correcto = false;

            if ($correcto) $conexion->commit(); else $conexion->rollBack();
            echo $correcto;
        }else{
            echo "existe";
        }
        break;
}
