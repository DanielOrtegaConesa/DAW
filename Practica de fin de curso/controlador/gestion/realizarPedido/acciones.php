<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";

$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "verCarrito":
        session_start();
        $retornar = [];
        foreach ($_SESSION["cliente"]->getArticulos() as $indice => $valor) {
            $retornar["resultados"][$indice]["codArticulo"] = $valor->getCodArticulo();
            $retornar["resultados"][$indice]["img"] = $valor->getImg();
            $retornar["resultados"][$indice]["nombre"] = $valor->getNombre();
            $retornar["resultados"][$indice]["precio"] = $valor->getPrecio();
            $retornar["resultados"][$indice]["cantidad"] = $valor->getCantidad();
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "eliminarArticulo":
        $cod = $_REQUEST["codArticulo"];
        session_start();
        $_SESSION["cliente"]->eliminarArticulo($cod);
        break;
    case "cambiarCantidad":
        $retornar["correcto"] = true;
        $cod = $_REQUEST["codArticulo"];
        $cantidad = $_REQUEST["cantidad"];
        if (esnumero($cantidad) && $cantidad>0) {
            session_start();
            $articulo = $_SESSION["cliente"]->getArticulo($cod);
            $cantidadActual = $articulo->getCantidad();
            if ($cantidad != $cantidadActual) {
                $articulo->setCantidad($cantidad);
            } else {
                $retornar["correcto"] = false;
            }
        } else {
            $retornar["correcto"] = false;
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "tramitarPedido":
        session_start();
        if (count($_SESSION["cliente"]->getArticulos()) > 0) {

            $conexion->beginTransaction();
            $retornar["correcto"] = true;

            $fecha = fechaActualMysql();
            $codCliente = $_SESSION["cliente"]->getCodCliente();

            // insert pedido
            $adatos = arrayDatosPDO(
                "codCliente,,fecha,,generadoPorCliente", "$codCliente,,$fecha,,0");
            if (!insertPrepPDO($conexion, "pedidos", $adatos)) $retornar["correcto"] = false;

            $codPedido = selectPrepPDO($conexion, "codPedido", "pedidos", $adatos);
            $codPedido = $codPedido[0]["codPedido"];

            // insert lineas
            $linea = 0;

            foreach ($_SESSION["cliente"]->getArticulos() as $indice => $articulo) {
                $linea++; // quiero que empieze en 1

                if ($retornar["correcto"]) {
                    $articulo->cargar($conexion); // por si han habido cambios en los datos del articulo

                    $adatos = arrayDatosPDO(
                        "numLineaPedido,,codPedido,,codArticulo,,codUsuarioGestion,,precio,,cantidad",
                        "$linea,,$codPedido,," . $articulo->getCodArticulo() . ",," . $_SESSION["usuario"]->getCodUsuarioGestion() . ",," . $articulo->getPrecio() . ",," . $articulo->getCantidad()
                    );

                    if (!insertPrepPDO($conexion, "lineasPedidos", $adatos)) $retornar["correcto"] = false;
                }
            }
            if ($retornar["correcto"]) {
                $conexion->commit();
            } else {
                $conexion->rollBack();
            }

        } else {
            $retornar["correcto"] = false;
        }

        $_SESSION["cliente"]->eliminarArticulos();
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
}
