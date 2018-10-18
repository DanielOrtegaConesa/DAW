<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminar":
        $codAlbaran = $_REQUEST["codAlbaran"];
        $adatos = arrayDatosPDO("codAlbaran", "$codAlbaran");
        if (!existeregistroPrepPDO($conexion, "lineasFacturas", $adatos)) {
            $conexion->beginTransaction();
            $correcto = true;
            if (!borrarPrepPDO($conexion, "lineasAlbaranes", $adatos)) $correcto = false;
            if (!borrarPrepPDO($conexion, "albaranes", $adatos)) $correcto = false;

            if ($correcto) $conexion->commit(); else $conexion->rollBack();
            echo $correcto;
        } else {
            echo "existe";
        }
        breaK;

    case "facturar":
        session_start();
        $retornar["mensaje"] = [];
        $_SESSION["usuario"]->cargar($conexion);
        $seleccionados = json_decode($_REQUEST['seleccionados']);
        $descuentoGlobal = $_REQUEST["descuento"];

        $fecha = fechaActualMysql();
        $correcto = true;

        $codCliente = "";

        $conexion->beginTransaction();

        $facturaActualizada = false;
        if (count($seleccionados) > 0) {
            if (esnumero($descuentoGlobal)) {
                if ($descuentoGlobal < 100) {
                    if (!insertPrepPDO($conexion, "facturas", arrayDatosPDO("fecha,,descuentoFactura", $fecha . ",," . $descuentoGlobal))) {
                        $correcto = false;
                        $retornar["mensaje"] = "Ha ocurrido un error inesperado (insert Factura)";
                    }
                    $codFactura = selectPDO($conexion, "codFactura", "facturas", "fecha = '$fecha'")[0]["codFactura"];

                    $linea = 0;
                    foreach ($seleccionados as $i => $codAlbaran) {

                        // si no existe ya un registro con ese albaran
                        if (!existeregistroPrepPDO($conexion, "lineasFacturas", arrayDatosPDO("codAlbaran", "$codAlbaran"))) {
                            //recogemos los datos de la linea
                            $datosAlbaran = selectPrepPDO($conexion, "*", "lineasAlbaranes INNER JOIN albaranes ON albaranes.codAlbaran = lineasAlbaranes.codAlbaran", arrayDatosPDO("albaranes.codAlbaran", $codAlbaran));

                            //para cada elemento de la linea
                            foreach ($datosAlbaran as $x => $lineaAlbaran) {

                                // tienen que ser del mismo cliente
                                if ($codCliente == "") {
                                    $codCliente = $datosAlbaran[$x]["codCliente"];
                                } else {
                                    if ($codCliente != $datosAlbaran[$x]["codCliente"]) {
                                        $correcto = false;// solo se procesan facturas del mismo cliente
                                        $retornar["mensaje"] = "Factura albabranes de un mismo cliente";
                                    }
                                }

                                if (!$facturaActualizada) {
                                    if (!updatePrepPDO($conexion, "facturas", "fecha = '$fecha'", arrayDatosPDO("codCliente", $lineaAlbaran["codCliente"]))) {
                                        $correcto = false;
                                        $retornar["mensaje"] = "Ha ocurrido un error inesperado (update)";
                                    } else {
                                        $facturaActualizada = true;
                                    }
                                }

                                $linea++;
                                if (!insertPrepPDO($conexion, "lineasFacturas", arrayDatosPDO(
                                    "numLineaFactura,,codFactura,,codArticulo,,codUsuarioGestion,,numLineaAlbaran,,codAlbaran,,precio,,cantidad,,descuento,,iva",
                                    "$linea,,$codFactura,," . $lineaAlbaran["codArticulo"] . ",," . $_SESSION["usuario"]->getCodUsuarioGestion() . ",," . $lineaAlbaran["numLineaAlbaran"] . ",," . $lineaAlbaran["codAlbaran"] . ",," . $lineaAlbaran["precio"] . ",," . $lineaAlbaran["cantidad"] . ",," . $lineaAlbaran["descuento"] . ",," . $lineaAlbaran["iva"]
                                ))) {
                                    $correcto = false;
                                    $retornar["mensaje"] = "Ha ocurrido un error inesperado (insert linea)";
                                }
                            }

                        } else {
                            $correcto = false;
                            $retornar["mensaje"] = "Ha ocurrido un error inesperado";
                        }
                    }
                } else {
                    $correcto = false;
                    $retornar["mensaje"] = "El descuento debe ser inferior a 100";
                }
            } else {
                $correcto = false;
                $retornar["mensaje"] = "El descuento debe ser numerico";
            }
        } else {
            $correcto = false;
            $retornar["mensaje"] = "No has seleccionado ninguno";
        }

        if ($correcto) $conexion->commit(); else $conexion->rollBack();

        $retornar["correcto"] = $correcto;
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
}
