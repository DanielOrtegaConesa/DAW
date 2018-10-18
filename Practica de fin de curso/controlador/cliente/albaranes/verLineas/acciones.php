<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";
include_once "../../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminar":
        $codAlbaran = $_REQUEST["codAlbaran"];
        $numLineaAlbaran = $_REQUEST["numLineaAlbaran"];

        $adatos = arrayDatosPDO("codAlbaran", "$codAlbaran");

        if (!existeregistroPrepPDO($conexion, "lineasFacturas", $adatos)) {
            $conexion->beginTransaction();
            $correcto = true;

            $adatos2 = arrayDatosPDO("codAlbaran,,numLineaAlbaran", "$codAlbaran,,$numLineaAlbaran");
            if (!borrarPrepPDO($conexion, "lineasAlbaranes", $adatos2)) $correcto = false;

            if ($correcto) $conexion->commit(); else $conexion->rollBack();
        }
        break;
    case "editar":
        $codAlbaran = $_REQUEST["codAlbaran"];
        $numLineaAlbaran = $_REQUEST["numLineaAlbaran"];
        $adatos = arrayDatosPDO("lineasAlbaranes.codAlbaran,,numLineaAlbaran", "$codAlbaran,,$numLineaAlbaran");

        $retornar["todoslosarticulos"] = selectPrepPDO($conexion, "*", "articulos", arrayDatosPDO(1, 1));
        $retornar["datosLinea"] = selectPrepPDO($conexion, "*",
            "albaranes
                INNER JOIN lineasAlbaranes
                on albaranes.codAlbaran = lineasAlbaranes.codAlbaran",
                $adatos
        )[0];
        $retornar["datosLinea"]["descripcion"] = "";


        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "actualizar":
        $codAlbaran = $_REQUEST["codAlbaran"];
        $numLineaAlbaran = $_REQUEST["numLineaAlbaran"];

        $adatos = arrayDatosPDO("codAlbaran,,numLineaAlbaran", "$codAlbaran,,$numLineaAlbaran");

        $iva = $_REQUEST["iva"];
        $precio = $_REQUEST["precio"];
        $descuento = $_REQUEST["descuento"];

        if (esnumero($iva) && esnumero($precio) && esnumero($descuento) && $iva > 0 && $precio > 0 && $descuento >= 0) {
            if (existeregistroPrepPDO($conexion, "lineasAlbaranes", arrayDatosPDO("codAlbaran,,numLineaAlbaran", $codAlbaran . ",," . $numLineaAlbaran))) {
                if (!existeregistroPrepPDO($conexion, "lineasFacturas", arrayDatosPDO("numLineaAlbaran,,codAlbaran", "$numLineaAlbaran,,$codAlbaran"))) {
                    updatePrepPDO($conexion, "lineasAlbaranes", "codAlbaran = '$codAlbaran' AND numLineaAlbaran = '$numLineaAlbaran'", arrayDatosPDO("iva,,precio,,descuento", "$iva,,$precio,,$descuento"));
                }
            }

        } else {

        }
        break;
}
