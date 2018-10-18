<?php

/**
 * Funciones para la gestion de una base de datos, contendra metodos validos PDO
 * @author Daniel Ortega Conesa
 * */

define("SERVIDOR", "danielorqcdani.mysql.db");
define("DB", "danielorqcdani");
define("USUARIOL", "danielorqcdani");
define("USUARIOC", "danielorqcdani");
define("USUARIOG", "danielorqcdani");
define("PASSWORDL", "660970218Da");
define("PASSWORDC", "660970218Da");
define("PASSWORDG", "660970218Da");
/*
define("SERVIDOR", "localhost");
define("DB", "trabajo_daw");
define("USUARIOL", "limitado");
define("USUARIOC", "cliente");
define("USUARIOG", "gestor");
define("PASSWORDL", "limitado");
define("PASSWORDC", "cliente");
define("PASSWORDG", "gestor");*/



/*
 *  Creacion de estructura de datos que sera utilizada para diversas operaciones
 *  Ejemplo de uso: arrayDatos("c0l,,col2,,col3","dato1,,dato2,,dato3")
 *  Es el mismo que el de mysqli
 */
function arrayDatosPDO($nombrescol, $valores, $delimitador = ",,")
{
    $Afinal = [];
    $Avalores = explode($delimitador, $valores);


    $Anombres = explode(",,", $nombrescol);

    /*print_r($Avalores);
     print_r($Anombres);*/

    if (count($Anombres) != count($Avalores)) {
        return false;
    }

    for ($c = 0; $c < count($Anombres); $c++) {
        $Afinal[] = array("columna" => $Anombres[$c], "valor" => $Avalores[$c]);
    }


    return $Afinal;
}


///////////////////////////////////////////////////////////////////////////////////////////

function conectarPDO($SERVIDOR, $BBDD, $USUARIO, $PASSWORD)
{
    $conexion = new PDO("mysql:host=$SERVIDOR;dbname=$BBDD;charset=UTF8", $USUARIO, $PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conexion->errorInfo()[0] != "0") {
        return false;
    }

    return $conexion;
}

function desconectarPDO($conexion)
{
    $conexion->close();
    return true;
}

///////////////////////////////////////////////////////////////////////////////////////////
///
/*
 * Funcion basica de insertado de datos
 */
function insertPDO($conexion, $tabla, $valores)
{
    try {
        $sentencia = "INSERT INTO $tabla VALUES ($valores)";
        $conexion->query($sentencia);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/*
 * Funcion de insercion de datos mediante consultas preparadas,
 * se le pasa un array con los  valores a introducir en el orden de insercion
 */
function insertPrepPDO($conexion, $tabla, $arrayDatos)
{
    try {
        $arrayValores = [];

        $sentencia = "INSERT INTO $tabla ( ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . ", ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 2);
        $sentencia .= ")";
        $sentencia .= "VALUES (";
        foreach ($arrayValores as $indice => $valor) {
            $sentencia .= "?,";
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 1);
        $sentencia .= ")";


        $sen_prep = $conexion->prepare($sentencia);
        $res = $sen_prep->execute($arrayValores);
        return true;
        // echo $sentencia;
    } catch (Exception $e) {
       /* echo $sentencia;
        print_r($arrayValores);
        echo $e;*/
    }
    return false;
}


///////////////////////////////////////////////////////////////////////////////////////////

/*
 * Funcion basica de comprobacion de existencia de un registro
 */
function existeregistroPDO($conexion, $tabla, $condicion)
{
    try {
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $conexion->query($sql);
    } catch (Exception $e) {
        return false;
    }

    if ($resultado->rowCount() <= 0) {
        return false;
    } else {
        return true;
    }
}

function existeregistroPrepPDO($conexion, $tabla, $arrayDatos)
{
    try {
        $arrayValores = [];
        $sentencia = "SELECT * FROM $tabla WHERE ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . " = ? AND ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 4);

        $sen_prep = $conexion->prepare($sentencia);
        $res = $sen_prep->execute($arrayValores);
        if ($sen_prep->rowCount() > 0) {
            return true;
        }
    } catch (Exception $e) {
       /* echo $sentencia;
         echo "error: ".$e;*/
    }
    return false;
}

///////////////////////////////////////////////////////////////////////////////////////////

/*
 * Funcion basica de actualizado de datos, recibe el parameto arrayDatos el cual
 * es un array asociativo que contiene nombre de la columna y valor, este array
 * se genera con el metodo arrayDatos
 */
function updatePDO($conexion, $tabla, $condicion, $arrayDatos)
{
    try {
        if (existeregistroPDO($conexion, $tabla, $condicion)) {
            $cadena_valores = "";
            for ($c = 0; $c < count($arrayDatos); $c++) {
                if ($c < count($arrayDatos) - 1) {
                    $cadena_valores .= $arrayDatos[$c]["columna"] . "='" . $arrayDatos[$c]["valor"] . "', ";
                } else {
                    $cadena_valores .= $arrayDatos[$c]["columna"] . "='" . $arrayDatos[$c]["valor"] . "'";
                }
            }

            $sentencia = "UPDATE $tabla SET $cadena_valores WHERE $condicion";
            $conexion->query($sentencia);
            return true;
        }
    } catch (Exception $e) {
        return false;
    }
}

function updatePrepPDO($conexion, $tabla, $condicion, $arrayDatos)
{
    try {
        $arrayValores = [];

        $sentencia = "UPDATE $tabla SET ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . " = ? , ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 3);
        $sentencia .= " WHERE $condicion";

        $sen_prep = $conexion->prepare($sentencia);

        $sen_prep->execute($arrayValores);/*
        echo $sentencia . "<br/>";
        print_r($arrayValores);
        echo "<br>";
        echo "<br>";*/

        if ($sen_prep->rowCount() > 0) {
            return true;
        }else{
           // echo "no he encotrado";
        }

    } catch (Exception $e) {/*
        echo $sentencia;
        echo $e;*/
    }
    return false;
}

///////////////////////////////////////////////////////////////////////////////////////////
///
/*
 * Funcion de select que retorna un array tipo [numerofila][nombrecolumna] => [valorcolumna]
 */
function selectPDO($conexion, $campos, $tabla, $condicion)
{
    try {
        $sentencia = "SELECT $campos FROM $tabla WHERE $condicion";

        $resultado = $conexion->query($sentencia);
        $resultados = [];

        $nfila = 0;
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach ($fila as $indice => $campo) {
                $resultados[$nfila][$indice] = $campo;
            }
            $nfila++;
        }
        // print_r($resultados);
        return $resultados;
    } catch (Exception $e) {
        return false;
    }
    return false;
}

function selectPrepPDO($conexion, $campos, $tabla, $arrayDatos, $inicio = "", $limite = "")
{
    try {
        $arrayValores = [];

        $sentencia = "SELECT $campos FROM $tabla WHERE ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . " = ? AND ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 4);

        if ($limite != "") {
            $sentencia .= " LIMIT $inicio,$limite";
        }
        $sen_prep = $conexion->prepare($sentencia);

        $resultados = [];
        $sen_prep->execute($arrayValores);
        /*
                        echo $sentencia;
                        print_r($arrayValores);*/
        while ($fila = $sen_prep->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $fila;
        }
        //   print_r($resultados);
        if ($resultados != []) {
            return $resultados;
        }

    } catch (Exception $e) {
//echo $e;
    }
    return false;
}


function selectPrepPDOlike($conexion, $campos, $tabla, $arrayDatos, $inicio = "", $limite = "")
{
    try {
        $arrayValores = [];

        $sentencia = "SELECT $campos FROM $tabla WHERE ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . " LIKE ? AND ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 4);

        if ($limite != "") {
            $sentencia .= " LIMIT $inicio,$limite";
        }
        $sen_prep = $conexion->prepare($sentencia);

        $resultados = [];
        $sen_prep->execute($arrayValores);
        //echo $sentencia;

        while ($fila = $sen_prep->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $fila;
        }

        if ($resultados != []) {
            return $resultados;
        }

    } catch (Exception $e) {
        //   echo $e;
    }
    return false;
}

function borrarPrepPDO($conexion, $tabla, $arrayDatos)
{
    try {
        $arrayValores = [];

        $sentencia = "DELETE FROM $tabla WHERE ";
        foreach ($arrayDatos as $indice => $col) {
            $sentencia .= $col["columna"] . " = ? AND ";
            $arrayValores[] = $col["valor"];
        }
        $sentencia = substr($sentencia, 0, strlen($sentencia) - 4);

        $sen_prep = $conexion->prepare($sentencia);
        $sen_prep->execute($arrayValores);

        return true;
    } catch (Exception $e) {
      //   echo $e;
    }
    return false;
}

///////////////////////////////////////////////////////////////////////////////////////////

