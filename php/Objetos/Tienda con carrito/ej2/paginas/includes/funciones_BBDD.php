<?php

define("BBDD", "proveedores2");//     <---------------------------------------
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("PASSWORD", "");

function conectar()
{
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);

    if ($conexion->connect_errno != null) {
        // die es para que aga un echo y deje de ejecutar php, en este caso
        // al tener error de conexion no queremos que se pueda seguit
        die("Te has conectado mal, Numero de error: " . $conexion->connect_errno . "| error tipo: " . $conexion->connect_error);
    }
    echo "<br/>";
    return $conexion;
}

function desconectar($conexion)
{
    $conexion->close();
}


/* DATOS */

function arrayDatos($nombrescol, $valores)
{
    $Afinal = [];
    $Anombres = explode(",,", $nombrescol);
    $Avalores = explode(",,", $valores);
    if (count($Anombres) != count($Avalores)) {
        echo "<h1>Cantidad de columnas y valores son diferentes</h1>";
        return false;
    }

    for ($c = 0; $c < count($Anombres); $c++) {
        $Afinal[] = array("columna" => $Anombres[$c], "valor" => $Avalores[$c]);
    }

    return $Afinal;
}

function insert($conexion, $tabla, $valores)
{
    $sentencia = "insert into $tabla values ($valores)";
    if ($conexion->query($sentencia) != true) {
        /*echo($sentencia);
        var_dump($conexion);
        die();*/
        return false;
    }

    return true;

}

function delete($conexion, $tabla, $condicion)
{
    $sentencia = "DELETE FROM $tabla WHERE $condicion";
    // echo $sentencia;
    if ($conexion->query($sentencia) != true) {
        //var_dump($conexion);
        return false;
    }
    return true;

}

function update($conexion, $tabla, $arraydatos, $condicion)
{
    //if (existeRegistroSimple($conexion, $tabla, $condicion)) {
    $sentencia = "UPDATE $tabla SET ";

    foreach ($arraydatos as $indice => $Acolumna) {
        $sentencia .= $Acolumna["columna"] . " = '" . $Acolumna["valor"] . "',";
    }
    $sentencia = substr($sentencia, 0, strlen($sentencia) - 1);

    $sentencia .= " WHERE $condicion";


    if ($conexion->query($sentencia)) {
        return true;
    }

    //}
    return false;

}

function selectundato($conexion, $campo, $tabla, $condicion)
{
    $sentencia = "SELECT $campo FROM $tabla WHERE $condicion";

    if ($resultado = $conexion->query($sentencia)) {
        $fila = $resultado->fetch_row();
        return $fila[0];
    }
}

function select($conexion, $campos, $tabla, $condicion)
{
    $sentencia = "SELECT $campos FROM $tabla WHERE $condicion";

    if ($resultado = $conexion->query($sentencia)) {
        $fila = $resultado->fetch_assoc();
        $resultados = [];
        foreach ($fila as $indice => $campo) {
            $resultados[$indice] = $campo;
        }


        return $resultados;
    }
}


/* COMPROBACIONES */

function existeRegistroSimple($conexion, $tabla, $condicion)
{
    $sql = "select * from $tabla where $condicion";

    $resultado = $conexion->query($sql);

    if (!$resultado || $conexion->connect_errno != null) return null;

    if ($resultado->num_rows <= 0) {
        return false;
    } else {
        return true;
    }
}

function existeRegistro($conexion, $tabla, $arraydatos)
{
    $sql = "select * from $tabla where 1=1";

    foreach ($arraydatos as $indice => $Acolumna) {
        $sql .= " AND " . $Acolumna["columna"] . " = " . $Acolumna["valor"];
    }

    $resultado = $conexion->query($sql);

    if (!$resultado || $conexion->connect_errno != null) return null;

    if ($resultado->num_rows <= 0) {
        return false;
    } else {
        return true;
    }
}


/* DEPRECADOS */

////Estas funciones planean ser borradas, estan apartadas dado que las que las reemplazan estan de prueba

/*



*/
