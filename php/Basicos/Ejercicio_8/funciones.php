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

function imprimearraybi($array)
{
    echo "<br/>";
    for ($c = 0; $c < count($array); $c++) {
        for ($d = 0; $d < count($array[0]); $d++) {
            echo $array[$c][$d] . " ";
        }
        echo "<br/>";
    }
}

function imprimearray($array)
{
    echo "<br/>";
    for ($c = 0; $c < count($array); $c++) {
        echo $array[$c];
        echo "<br/>";
    }
}

/*** CONTROL ***/

function esnumero($numero)
{
    $correcto = true;
    for ($c = 0; $c < strlen($numero); $c++) {
        if ((ord($numero[$c]) >= 48) && ord($numero) <= 57) {

        } else {
            $correcto = false;
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
        if (((ord($cadena[$c]) >= 65) && ord($cadena[$c]) <= 90 )||ord($cadena[$c])==32) {

        } else {
            $correcto = false;
        }
    }
    return $correcto;
}


?>