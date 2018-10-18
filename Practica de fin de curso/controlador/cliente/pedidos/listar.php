<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";

$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
session_start();

$codCliente = $_SESSION["usuario"]->getCodCliente();
$arraydatos = arrayDatosPDO("clientes.codCliente", "$codCliente");

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
        $arraydatos = arrayDatosPDO($cbuscar . ",,clientes.codCliente", "%" . $tbuscar . "%,,$codCliente");
        if ($cbuscar == "codPedido" || $cbuscar == "fecha") {
            $arraydatos = arrayDatosPDO($cbuscar . ",,clientes.codCliente", $tbuscar . "%,,$codCliente");
        }
    }
}

$pag = $inicio * $limit;

$total = selectPrepPDOlike($conexion, "count(*)", "pedidos
        INNER JOIN clientes 
        ON clientes.codCliente = pedidos.codCliente", $arraydatos);

if ($total) {
    $total = $total[0]["count(*)"];

    $pagFinal = ceil($total / $limit);

    $resultados = selectPrepPDOlike($conexion, "*", "pedidos
        INNER JOIN clientes 
        ON clientes.codCliente = pedidos.codCliente", $arraydatos, $pag, $limit);
    $retornar["fin"] = $pagFinal;
    if ($resultados) {
        foreach ($resultados as $indice => $resultado) {

            $estado = "En espera";
            $adatos = arrayDatosPDO("codPedido", $resultado["codPedido"]);

            if (existeregistroPrepPDO($conexion, "lineasAlbaranes", $adatos)) {
                $estado = "En proceso";
                $lineasPedido = selectPrepPDO($conexion, "count(*)", "lineasPedidos", $adatos)[0]["count(*)"];
                $lineasAlbaranes = selectPrepPDO($conexion, "count(*)", "lineasAlbaranes", $adatos)[0]["count(*)"];
                if ($lineasPedido == $lineasAlbaranes) {
                    $estado = "Terminado";
                }
            }
            $carticulospedido = selectPrepPDO($conexion, "count(*)", "lineasPedidos", $adatos)[0]["count(*)"];


            $borrable = false;
            if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", $adatos)) $borrable = true;
            $retornar["resultados"][$indice]["nick"] = $resultado["nick"];
            $retornar["resultados"][$indice]["generadoPorCliente"] = $resultado["generadoPorCliente"];
            $retornar["resultados"][$indice]["cantidadArticulos"] = $carticulospedido;
            $retornar["resultados"][$indice]["codPedido"] = $resultado["codPedido"];
            $retornar["resultados"][$indice]["fecha"] = $resultado["fecha"];
            $retornar["resultados"][$indice]["estado"] = "";
            $retornar["resultados"][$indice]["borrable"] = $borrable;
            $retornar["resultados"][$indice]["estado"] = $estado;
        }
    }

    echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
}