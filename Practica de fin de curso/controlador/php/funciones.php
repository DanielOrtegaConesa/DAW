<?php

/*** ARRAYS ***/

//Esta función recibe un array y devuelve una cadena
function array_a_cadenaurl($array)
{
    $cadenatmp = serialize($array);
    $cadena = urlencode($cadenatmp);
    return $cadena;
}

//Esta función recibe una cadena y devuelve un array
function cadenaurl_a_array($texto)
{
    $array = array();
    if ($texto != "") {
        $texto = stripslashes($texto);
        $texto = urldecode($texto);
        $array = unserialize($texto);
    }
    return $array;
}


/*** CONTROL ***/

function esnumero($numero)
{
    $correcto = true;
    for ($c = 0; $c < strlen($numero) && $correcto; $c++) {
        if ((ord($numero[$c]) >= 48) && (ord($numero[$c]) <= 57)) {
        } else {
            if ($numero[$c] != ".") {
                $correcto = false;
            }
        }
    }
    return $correcto;
}

function esletra($letra)
{
    $letra = strtoupper($letra);
    $correcto = true;
    for ($c = 0; $c < strlen($letra); $c++) {
        if ((ord($letra[$c]) >= 65) && ord($letra[$c]) <= 90) {

        } else {
            $correcto = false;
        }
    }
    return $correcto;
}

function esletraconespacio($cadena)
{
    $cadena = strtoupper($cadena);
    $correcto = true;
    for ($c = 0; $c < strlen($cadena); $c++) {
        if (((ord($cadena[$c]) >= 65) && ord($cadena[$c]) <= 90) || ord($cadena[$c]) == 32) {

        } else {
            $correcto = false;
        }
    }
    return $correcto;
}

function encriptar($valor)
{
    return password_hash($valor, PASSWORD_DEFAULT);
}

function validarDni($dni)
{
    $letra = substr($dni, -1);
    $letra = strtoupper($letra);
    $numeros = substr($dni, 0, -1);
    if (is_numeric($numeros)) {
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function esinf($texto, $maxsize)
{
    $size = strlen($texto);
    return ($size > 0 && $size <= $maxsize);

}

function rutaFichero($fichero)
{
    $dirPaths = [];
    $dirPaths[] = './';

    $dirPaths[] = '../';
    $dirPaths[] = '../../';
    $dirPaths[] = '../../../';
    $dirPaths[] = '../../../../';
    $dirPaths[] = '../../../../../';
    $dirPaths[] = '../../../../../../';
    $dirPaths[] = '../../../../../../../';
    $dirPaths[] = '../../../../../../../../';

    foreach ($dirPaths as $path) {
        $classPath = $path . $fichero;
        if (file_exists($classPath) && is_file($classPath)) {
            return $classPath;
        }
    }
}

function fechaActualMysql()
{
    return date("Y-m-d H:i:s");
}