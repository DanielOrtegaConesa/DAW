<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
$arraydatos = arrayDatosPDO("1", "1");

$inicio = 1;
$limit = 12;
if (isset($_REQUEST["pag"])) {
    $inicio = $_REQUEST["pag"];
}
if (isset($_REQUEST["limit"])) {
    $limit = $_REQUEST["limit"];
}

$pag = $inicio * $limit;

if (isset($_REQUEST["cbuscar"]) & isset($_REQUEST["tbuscar"])) {
    $cbuscar = $_REQUEST["cbuscar"];
    $tbuscar = $_REQUEST["tbuscar"];

    if ($tbuscar != "") {

        if ($cbuscar == "nombre") {
            $total = selectPDO($conexion, "count(*)", "articulos", "nombre LIKE '%$tbuscar%'");
            $resultados = selectPDO($conexion, "*", "articulos", "nombre LIKE '%$tbuscar%' LIMIT $pag,$limit");
        }

        if ($cbuscar == "precioI") {
            $total = selectPDO($conexion, "count(*)", "articulos", "precio < $tbuscar");
            $resultados = selectPDO($conexion, "*", "articulos", "precio < $tbuscar LIMIT $pag,$limit");
        }
        if ($cbuscar == "precioS") {
            $total = selectPDO($conexion, "count(*)", "articulos", "precio > $tbuscar");
            $resultados = selectPDO($conexion, "*", "articulos", "precio > $tbuscar LIMIT $pag,$limit");
        }
    }else{
        $total = selectPrepPDOlike($conexion, "count(*)", "articulos", $arraydatos);
    }

} else {
    $total = selectPrepPDOlike($conexion, "count(*)", "articulos", $arraydatos);
}

if ($total) {
    $total = $total[0]["count(*)"];

    $pagFinal = ceil($total / $limit);

    if (!isset($resultados)) {
        $resultados = selectPrepPDOlike($conexion, "*", "articulos", $arraydatos, $pag, $limit);
    }

    $retornar["fin"] = $pagFinal;

    $retornar["resultados"] = $resultados;

    echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
}