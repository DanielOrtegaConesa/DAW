<?php
include "funciones.php";

function codificar($texto, $semilla)
{
// todo a mayuscula
    $texto = strtoupper($texto);
    $semilla = strtoupper($semilla);

    $abecedario = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

    $textocodificado = "";

    for ($c = 0; $c < strlen($texto); $c++) {
        if ($texto[$c] == " ") {
            $textocodificado .= " ";
        } else {

            if ((strpos($abecedario, $texto[$c]) === false) && (strpos($abecedario, $texto[$c]) !== "0")) {
                $textocodificado .= "?";
            } else {
                $s = $c % strlen($semilla);
                // posiciones 0123...0123

                $pabecedario = strpos($abecedario, $texto[$c]);
                $psemilla = strpos($abecedario, $semilla[$s]) + 1;
                $suma = $pabecedario + $psemilla;


                while ($suma >= 28) {
                    $suma -= 28;
                }


                $textocodificado .= $abecedario[$suma];
            }
        }

    }
    return $textocodificado;

}

function decodificar($codificado, $semilla)
{
// todo a mayuscula
    $codificado = strtoupper($codificado);
    $semilla = strtoupper($semilla);


    $abecedario = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $textodecodificado = "";

    for ($c = 0; $c < strlen($codificado); $c++) {
        if ($codificado[$c] == " ") {
            $textodecodificado .= " ";
        } else {
            if ((strpos($abecedario, $codificado[$c]) === false) && (strpos($abecedario, $codificado[$c]) !== "0")) {
                $textodecodificado .= "?";
            } else {

                $s = $c % strlen($semilla);

                $pabecedario = strpos($abecedario, $codificado[$c]);
                $psemilla = strpos($abecedario, $semilla[$s]) + 1;
                $suma = $pabecedario - $psemilla;


                $textodecodificado .= $abecedario[$suma];
            }

        }

    }
    return $textodecodificado;

}


?>

<html>
<head>
    <title>cifrado</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
</head>
<body>
<?php

if (!isset($_GET["texto"])) {
    ?>
    <form>
        texto a codificar:<input type="text" name="texto" placeholder="introduce un texto">
        <br/>
        semilla:<input type="text" name="semilla" placeholder="introduce una semilla">
        <input type="submit">
    </form>
    <?php
} else {

    $mensaje = $_GET["texto"];
    $semilla = $_GET["semilla"];
    if ($semilla == "") {
        $semilla = "ABCD";
    }
    $mensajecodificado = codificar($mensaje, $semilla);
    echo "Mensaje codificado: " . $mensajecodificado;
    echo "<br/>";
    $mensajedecodificado = decodificar($mensajecodificado, $semilla);
    echo "Mensaje decodificado: " . $mensajedecodificado;
}
?>
</body>
</html>
