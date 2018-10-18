<?php
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

function esmayora2($numero)
{
    $correcto = false;
    if (esnumero($numero)) {

        if ($numero > 2) {
            $correcto = true;
        }

    }
    return $correcto;
}

?>
<html>
<head>
    <title>Piramide</title>
    <meta charset="utf-8">
    <style type="text/css">
        * {
            text-align: center;
        }
    </style>
</head>
<body>

<?php
$_GET["numero"];
$_POST["numero"];
$_REQUEST[""];

if (isset($_GET["numero"]) && esmayora2($_GET["numero"])) {
    $numero = $_GET["numero"];
    $maximo = $numero;
    $minimo = 1;
        for ($x = 0; $x < $numero; $x++) {
            for ($c = $maximo; $c >= $minimo; $c--) {
                echo $c;
            }
            for ($d = $minimo + 1; $d <= $maximo; $d++) {
                echo $d;
            }
            $maximo--;
            echo "<br/>";
        }
    echo "<br/>";
    $maximob = 1;
    $minimob = 1;
        for ($x = 0; $x < $numero; $x++) {
            for ($c = $maximob; $c >= $minimob; $c--) {
                echo $c;
            }
            for ($d = $minimob + 1; $d <= $maximob; $d++) {
                echo $d;
            }
            $maximob++;
            echo "<br/>";
        }

} else {
    if(isset($_GET["numero"]) && !esmayora2($_GET["numero"])){
        echo "<h2>El numero debe ser superior a 2</h2>";
    }
    ?>
    <form method="post">
        Numero:<input type="text" name="numero" placeholder="numero">
        <input type="submit">
    </form>
    <?php
}

?>
</body>
</html>
