<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

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

        }else{
            echo "existe";
        }
        breaK;
    case "verLineas":
       /* $codPedido = $_REQUEST["codPedido"];
        $adatos = arrayDatosPDO("lineasPedidos.codPedido", "$codPedido");
        $retornar["correcto"] = true;
        if (existeregistroPrepPDO($conexion, "lineasPedidos", $adatos)) {

           $resultados = selectPrepPDO($conexion, "*",
                "pedidos
                INNER JOIN lineasPedidos
                on pedidos.codPedido = lineasPedidos.codPedido

                INNER JOIN clientes
                ON clientes.codCliente = pedidos.codCliente

                INNER JOIN articulos
                ON articulos.codArticulo = lineasPedidos.codArticulo"
                , $adatos);
            foreach ($resultados as $indice => $resultado) {
                $resultados[$indice]["pass"] = "";
                $resultados[$indice]["descripcion"] = "";
            }
            $retornar["resultados"] = $resultados;

        } else {
            $retornar["correcto"] = false;
        }

        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);*/
        break;
}
