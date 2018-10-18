<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";
include_once "../../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminar":
        $codPedido = $_REQUEST["codPedido"];
        $numLineaPedido = $_REQUEST["numLineaPedido"];

        $adatos = arrayDatosPDO("codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");

        if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", $adatos)) {
            $conexion->beginTransaction();
            $correcto = true;

            $adatos2 = arrayDatosPDO("codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");
            if (!borrarPrepPDO($conexion, "lineasPedidos", $adatos2)) $correcto = false;

            $cantidadLineas = selectPrepPDO($conexion, "count(*)", "lineasPedidos", arrayDatosPDO("codPedido",$codPedido))[0]["count(*)"];
            if (!$cantidadLineas) {
                if (!borrarPrepPDO($conexion, "pedidos", arrayDatosPDO("codPedido", $codPedido))) $correcto = false;
            }
            if ($correcto) $conexion->commit(); else $conexion->rollBack();
        }
        break;
    case "editar":
        $codPedido = $_REQUEST["codPedido"];
        $numLineaPedido = $_REQUEST["numLineaPedido"];
        $adatos = arrayDatosPDO("lineasPedidos.codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");

        $retornar["todoslosarticulos"] = selectPrepPDO($conexion, "*", "articulos", arrayDatosPDO(1, 1));
        $retornar["datosLinea"] = selectPrepPDO($conexion, "*",
            "pedidos
                INNER JOIN lineasPedidos
                on pedidos.codPedido = lineasPedidos.codPedido
    
                INNER JOIN articulos
                ON articulos.codArticulo = lineasPedidos.codArticulo",
            $adatos
        )[0];
        $retornar["datosLinea"]["descripcion"] = "";


        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "actualizar":
        $codPedido = $_REQUEST["codPedido"];
        $numLineaPedido = $_REQUEST["numLineaPedido"];

        $adatos = arrayDatosPDO("codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");

        $cantidad = $_REQUEST["cantidad"];
        $codArticulo = $_REQUEST["codArticulo"];

        if (esnumero($cantidad) && $cantidad > 0) {
            if (existeregistroPrepPDO($conexion, "lineasPedidos", arrayDatosPDO("codPedido,,numLineaPedido", $codPedido . ",," . $numLineaPedido))) {
                if (existeregistroPrepPDO($conexion, "articulos", arrayDatosPDO("codArticulo", $codArticulo))) {

                    if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", arrayDatosPDO("numLineaPedido,,codPedido", "$numLineaPedido,,$codPedido"))) {
                        updatePrepPDO($conexion, "lineasPedidos", "codPedido = '$codPedido' AND numLineaPedido = '$numLineaPedido'", arrayDatosPDO("cantidad,,codArticulo", "$cantidad,,$codArticulo"));
                    }

                }
            }
        }
        break;
    case "procesar":
        session_start();
        $_SESSION["usuario"]->cargar($conexion);
        $seleccionados = json_decode($_REQUEST['seleccionados']);
        $correcto = true;

        if(count($seleccionados)>0) {
            $pedido = $seleccionados[0];

            $conexion->beginTransaction();

            if (existeregistroPrepPDO($conexion, "lineasAlbaranes", arrayDatosPDO("codPedido", "$pedido"))) {
                $numLineaAlbaran = selectPDO($conexion, "numLineaAlbaran", "lineasAlbaranes", " codPedido = '$pedido' ORDER BY numLineaAlbaran DESC LIMIT 1")[0]["numLineaAlbaran"];
                $codCliente = selectPDO($conexion, "codCliente", "pedidos", "codPedido='$pedido'")[0]["codCliente"];
                $fecha = fechaActualMysql();
                insertPrepPDO($conexion, "albaranes", arrayDatosPDO("codCliente,,fecha", "$codCliente,,$fecha"));
                $codAlbaran = selectPDO($conexion, "codAlbaran", "albaranes", " fecha = '$fecha'")[0]["codAlbaran"];
            } else {
                $codCliente = selectPDO($conexion, "codCliente", "pedidos", "codPedido='$pedido'")[0]["codCliente"];
                $fecha = fechaActualMysql();
                insertPrepPDO($conexion, "albaranes", arrayDatosPDO("codCliente,,fecha", "$codCliente,,$fecha"));
                $codAlbaran = selectPDO($conexion, "codAlbaran", "albaranes", " fecha = '$fecha'")[0]["codAlbaran"];
                $numLineaAlbaran = 0;
            }

            foreach ($seleccionados as $indice => $seleccionado) {
                $numLineaAlbaran++;
                echo "lineaAlbaran:" . $numLineaAlbaran;
                $seleccionados[$indice] = explode("-", $seleccionados[$indice]);
                $linea = $seleccionados[$indice][1];

                if (existeregistroPrepPDO($conexion, "lineasPedidos", arrayDatosPDO("codPedido,,numLineaPedido", "$pedido,,$linea"))) {
                    if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", arrayDatosPDO("codPedido,,numLineaPedido", "$pedido,,$linea"))) {

                        $datosPedido = selectPrepPDO($conexion, "*", "lineasPedidos", arrayDatosPDO("codPedido,,numLineaPedido", "$pedido,,$linea"))[0];
                        $datosArticulo = selectPrepPDO($conexion, "*", "articulos", arrayDatosPDO("codArticulo", $datosPedido["codArticulo"]))[0];

                        $adatos = arrayDatosPDO(
                            "numLineaAlbaran,,codAlbaran,,codArticulo,,codUsuarioGestion,,numLineaPedido,,codPedido,,precio,,cantidad,,descuento,,iva",
                            "$numLineaAlbaran,,$codAlbaran,," . $datosPedido["codArticulo"] . ",," . $_SESSION["usuario"]->getCodUsuarioGestion() . ",,$linea,,$pedido,," . $datosPedido["precio"] . ",," . $datosPedido["cantidad"] . ",," . $datosArticulo["descuento"] . ",," . $datosArticulo["iva"]
                        );
                        if (insertPrepPDO($conexion, "lineasAlbaranes", $adatos)) {
                        } else  $correcto = false;
                    } else  $correcto = false;
                } else  $correcto = false;
            }
            if ($correcto) $conexion->commit(); else $conexion->rollBack();
        }else{
            $correcto=false;
        }
        echo json_encode($correcto, JSON_UNESCAPED_UNICODE);
        break;
}
