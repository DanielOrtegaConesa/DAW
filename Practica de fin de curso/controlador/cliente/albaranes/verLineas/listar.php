<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";
session_start();
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
$codCliente = $_SESSION["usuario"]->getCodCliente();
$codAlbaran = $_REQUEST["codAlbaran"];

if (existeregistroPrepPDO($conexion, "albaranes", arrayDatosPDO("codCliente,,codAlbaran", "$codCliente,,$codAlbaran"))) {
    $adatos = arrayDatosPDO("lineasAlbaranes.codAlbaran", "$codAlbaran");
    $retornar["correcto"] = true;

    if (existeregistroPrepPDO($conexion, "lineasAlbaranes", $adatos)) {
        $resultados = selectPrepPDO($conexion, "*",
            "albaranes
                INNER JOIN lineasAlbaranes
                on albaranes.codAlbaran = lineasAlbaranes.codAlbaran

                INNER JOIN clientes
                ON clientes.codCliente = albaranes.codCliente
    
                INNER JOIN articulos
                ON articulos.codArticulo = lineasAlbaranes.codArticulo"
            , $adatos);
        foreach ($resultados as $indice => $resultado) {
            $resultados[$indice]["pass"] = "";
            $resultados[$indice]["descripcion"] = "";
            $resultados[$indice]["iva"] = selectPrepPDO($conexion, "iva", "lineasAlbaranes", $adatos)[$indice]["iva"];
            $resultados[$indice]["precio"] = selectPrepPDO($conexion, "precio", "lineasAlbaranes", $adatos)[$indice]["precio"];
            $resultados[$indice]["descuento"] = selectPrepPDO($conexion, "descuento", "lineasAlbaranes", $adatos)[$indice]["descuento"];
            $resultados[$indice]["mye"] = false;

            $cond = arrayDatosPDO("codAlbaran", "$codAlbaran");
            if (!existeregistroPrepPDO($conexion, "lineasFacturas", $cond)) $resultados[$indice]["mye"] = true;
        }
        $retornar["resultados"] = $resultados;
    } else {
        $retornar["correcto"] = false;
    }
} else {
    $retornar["correcto"] = false;
}

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);