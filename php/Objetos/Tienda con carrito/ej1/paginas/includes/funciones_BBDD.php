<?php

define("BBDD", "proveedoresCarrito");//     <---------------------------------------
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
    // echo $sentencia;
    if ($conexion->query($sentencia) != true) {
        //  var_dump($conexion);
        return false;
    }
    return true;

}

function update($conexion, $tabla, $arraydatos, $condicion)
{
    $sentencia = "UPDATE $tabla SET ";

    foreach ($arraydatos as $indice => $Acolumna) {
        $sentencia .= $Acolumna["columna"] . " = " . $Acolumna["valor"] . ",";
    }
    $sentencia = substr($sentencia, 0, strlen($sentencia) - 1);

    $sentencia .= " WHERE $condicion";

    if ($conexion->query($sentencia) != true) {
        echo $sentencia . "<br/>";
        echo "No se han modificado los valores";
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


////////////////////////////////////////

function realizarpedido($conexion)
{
    $conexion->autocommit(false);
    $correcto = true;// ante cualquier error, sera false

    $carrito = $_SESSION["carrito"];
    $hoy = date("Y-m-d H:i:s");

    /*NUMERO DE PEDIDO*/
    $sentencia = "select NUMPEDIDO from pedido order by NUMPEDIDO desc limit 0,1";
    $resultado = $conexion->query($sentencia);
    if ($resultado == false) {
        $correcto = false;
    }
    $fila = $resultado->fetch_assoc();
    $npedido = $fila["NUMPEDIDO"];
    $npedido++;
    /////////////////////


    $linea = 0;

    if (!insert($conexion, "PEDIDO", "$npedido," . $_SESSION["usuario"] . ",'$hoy'")) {
        $correcto = false;
    }

    foreach ($carrito->getPiezas() as $indice => $pieza) {
        if ($correcto) {
            $NUMPIEZA = $pieza->getNUMPIEZA();
            $PRECIOVENT = $pieza->getPRECIOVENT();

            $cantidad = $pieza->getCantidad();

            $sentencia = "INSERT INTO LINPED VALUES (?,?,?,?,?,NULL,NULL)";
            $consulta_prep = $conexion->prepare($sentencia);
            $consulta_prep->bind_param('issii', $npedido, $linea, $NUMPIEZA, $PRECIOVENT, $cantidad);

            if (!$resultado = $consulta_prep->execute()) {
                $correcto = false;
            }
            $linea++;
        }
    }

    if (!$correcto) {
        $conexion->rollback();
    }
    $conexion->commit();
    $conexion->autocommit(true);
}

function eliminarpedido($conexion, $numero)
{
    $conexion->autocommit(false);
    $correcto = true;

    $sentencia = "
DELETE l.*
FROM LINPED AS l
INNER JOIN PEDIDO AS p
ON l.NUMPEDIDO = p.NUMPEDIDO
WHERE p.NUMVEND = " . $_SESSION["usuario"] . " AND p.NUMPEDIDO = $numero";
    $resultado = $conexion->query($sentencia);
    if ($resultado == false) {
        $correcto = false;
    }

    $sentencia = "
DELETE FROM PEDIDO
WHERE NUMVEND = " . $_SESSION["usuario"] . " AND NUMPEDIDO = $numero";
    $resultado = $conexion->query($sentencia);
    if ($resultado == false) {
        $correcto = false;
    }

    if (!$correcto) {
        $conexion->rollback();;
    }

    $conexion->commit();
    $conexion->autocommit(true);

}


/* DEPRECADOS */

////Estas funciones planean ser borradas, estan apartadas dado que las que las reemplazan estan de prueba

/*



*/
