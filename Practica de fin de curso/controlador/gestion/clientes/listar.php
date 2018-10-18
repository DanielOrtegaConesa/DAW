<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);
$arraydatos = arrayDatosPDO("activo", "1");

$inicio = 1;
$limit = 10;
if (isset($_REQUEST["pag"])) {
    $inicio = $_REQUEST["pag"];
}
if (isset($_REQUEST["limit"])) {
    $limit = $_REQUEST["limit"];
}

if (isset($_REQUEST["cbuscar"]) & isset($_REQUEST["tbuscar"])) {
    $cbuscar = $_REQUEST["cbuscar"];
    $tbuscar = $_REQUEST["tbuscar"];
    if ($tbuscar != "") {
        $arraydatos = arrayDatosPDO($cbuscar . ",,activo", "%" . $tbuscar . "%,,1");
    }
}

$pag = $inicio * $limit;

$total = selectPrepPDOlike($conexion, "count(*)", "clientes", $arraydatos);
if ($total) {
    $total = $total[0]["count(*)"];

    $pagFinal = ceil($total / $limit);

    $resultados = selectPrepPDOlike($conexion, "nick, email, dni,razonSocial, telefono, activo,img", "clientes", $arraydatos, $pag, $limit);

    $retornar["fin"] = $pagFinal;
    if ($resultados) {
        foreach ($resultados as $indice => $resultado) {
            if ($resultado["activo"] == 1) {
                $retornar["resultados"][$indice]["img"] = $resultado["img"];
                $retornar["resultados"][$indice]["nick"] = $resultado["nick"];
                $retornar["resultados"][$indice]["email"] = $resultado["email"];
                $retornar["resultados"][$indice]["dni"] = $resultado["dni"];
                $retornar["resultados"][$indice]["razonSocial"] = $resultado["razonSocial"];
                $retornar["resultados"][$indice]["telefono"] = $resultado["telefono"];
            }
        }
    }
    echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
}