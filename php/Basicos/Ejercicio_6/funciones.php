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

function imprimearraybi($array, $borde = 0)
{
    echo "<table border='$borde'>";
    for ($c = 0; $c < count($array); $c++) {
        echo "<tr>";
        for ($d = 0; $d < count($array[0]); $d++) {
            echo "<td>" . $array[$c][$d] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
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
    for ($c = 0; $c < strlen($numero)&&$correcto; $c++) {
        if ((ord($numero[$c]) >= 48) && (ord($numero[$c]) <= 57)||$numero[$c]==".") {
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
        if (((ord($cadena[$c]) >= 65) && ord($cadena[$c]) <= 90) || ord($cadena[$c]) == 32) {

        } else {
            $correcto = false;
        }
    }
    return $correcto;
}

function comprobardni($dni)
{

    if (strlen($dni) < 9) {
        $errores[] = "DNI demasiado corto, deberia tener 8 digitos y una letra.";
    }

    $dni = strtoupper($dni);

    $letra = substr($dni, -1, 1);
    $numero = substr($dni, 0, 8);
    if (!esnumero($numero)) {
        $errores[] = "Los primeros 8 caracteres deben ser numeros";
    }
    if (!esletra($letra)) {
        $errores[] = "Los primeros 8 caracteres deben ser numeros";
    }
    if (empty($errores)) {
        $modulo = $numero % 23;
        $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_correcta = substr($letras_validas, $modulo, 1);

        if ($letra_correcta != $letra) {
            $errores[] = "Letra incorrecta, la letra debería ser la $letra_correcta.";
        }
    }
    if (!empty($errores)) {
        return $errores;
    }
    return "OK";
}


?>