<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "add":
        session_start();
        if($_SESSION["cliente"]->nuevoArticulo($conexion,$_REQUEST["codArticulo"])){
        $retornar["correcto"]=true;
        }else{
            $retornar["correcto"]=false;
        }

        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        breaK;
}
