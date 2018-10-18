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
    for ($c = 0; $c < strlen($numero) && $correcto; $c++) {
        if ((ord($numero[$c]) >= 48) && (ord($numero[$c]) <= 57)) {
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

function contardigimonesnivel1()
{
    $fichero = "../../digimones.txt";
    $digimones = 0;
    if (file_exists($fichero)) {
        $gestor = fopen($fichero, "r");
        while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n"))) {
            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
            if ($nivel == 1) {
                $digimones++;
            }
        }
        fclose($gestor);
    }
    return $digimones;
}

function contardigimonesnivel1de($usuario)
{
    $fichero = "../../usuarios/$usuario/digimones_usuario.txt\"";
    $digimones = 0;
    if (file_exists($fichero)) {
        $gestor = fopen($fichero, "r");
        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
            if ($nivel == 1) {
                $digimones++;
            }
        }
        fclose($gestor);
    }
    return $digimones;
}

function asignar3digimones($usuario)
{
    $fichero = "../../digimones.txt";
    $digimones = 0;
    $digimonesusuario = fopen("../../usuarios/$usuario/digimones_usuario.txt", "a+");

    if (file_exists($fichero)) {
        $gestor = fopen($fichero, "r");
        while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($digimones < 3)) {
            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
            if ($nivel == 1) {
                fwrite($digimonesusuario, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                $digimones++;
            }
        }
        fclose($gestor);
        fclose($digimonesusuario);
    }
    return $digimones;
}

function digimonlvl1aleatorio()
{

    $nivel1 = array();

    $ftodoslosdigi = "../../digimones.txt";
    $digimones = 0;
    if (file_exists($ftodoslosdigi)) {
        $gestor = fopen($ftodoslosdigi, "r");
        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
            if ($nivel == 1) {
                $nivel1[] = "$digimon\t$ataque\t$defensa\t$tipo\t$nivel\t$evolucion\n";
                $digimones++;
            }
        }
        fclose($gestor);
    }
    return $nivel1[rand(0, $digimones - 1)];

}

function regalardigimon($usuario)
{
    $existentes = contardigimonesnivel1();
    $usutiene = contardigimonesnivel1de($usuario);
    if ($existentes != $usutiene) {
        do {
            $correcto = true;
            $aleatorio = digimonlvl1aleatorio();
            $campos = explode("\t", $aleatorio);

            $fichero = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
            while ($filadigimon = fscanf($fichero, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                if ($campos[0] == $digimon) {
                    $correcto = false;
                }
            }

        } while ($correcto == false);
        return $aleatorio;
    } else {
        return false;
    }


}

?>