<?php
include "funciones.php";
$ttotal = 0;
$ctotal = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <meta name="description" content="Mi pagina">
    <meta name="author" content="Dani">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php

if (isset($_GET["enviar"])&&esnumero($_GET["tiempo"])) {

    $tiempo = $_GET["tiempo"];// tiempo que ha entrenado la persona

    if ($tiempo < 0) {
        $tiempo *= -1;
    }
    if ($tiempo > 60) {
        $tiempo = 60;
    }

    $calorias = 0;
    $minutos = 0; // minutos que se han procesado

    if (isset($_GET["cadenasesiones"])) {
        $sesiones = cadenaurl_a_array($_GET["cadenasesiones"]);
        $ttotal = $_GET["ttotal"];
        $ctotal = $_GET["ctotal"];
    }

    if ($minutos < $tiempo) {

        if ($minutos < 1) {
            $minutos++;
            $calorias += 2;
        }

        while ($minutos <= 10 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 3;
        }

        while ($minutos <= 20 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 4;
        }

        while ($minutos <= 30 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 5;
        }

        while ($minutos <= 40 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 6;
        }

        while ($minutos <= 50 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 7;
        }

        while ($minutos < 60 && $minutos < $tiempo) {
            $minutos++;
            $calorias += 8;
        }
    }

    if ($tiempo != 0) {
        $sesiones[] = "Tiempo: " . $minutos . " | Calorias: " . $calorias;
        $cadenasesiones = array_a_cadenaurl($sesiones);
        $ttotal += $tiempo;
        $ctotal += $calorias;
        header("location:inicioAdmin.php?cadenasesiones=" . urlencode($cadenasesiones) . "&ttotal=" . urlencode($ttotal) . "&ctotal=" . urlencode($ctotal)); //get implicito
    } else {
        if (isset($sesiones)) {
            imprimearray($sesiones);
        }
        echo "Tiempo total: " . $ttotal;
        echo "<br/>";
        echo "Calorias totales: " . $ctotal;
    }

} else {
    ?>
    <form action="inicio.php" method="get">
        <ul>
            <li><label for="tiempo">Tiempo de entrenamiento:</label> <input type="text" id="tiempo" name="tiempo"></li>
            <?php
            if (isset($_GET["cadenasesiones"])) {
                $cadenasesiones = $_GET["cadenasesiones"];
                $ttotal = $_GET["ttotal"];
                $ctotal = $_GET["ctotal"];
                ?>
                <input type="hidden" name="cadenasesiones" value="<?php echo $cadenasesiones ?>">
                <input type="hidden" name="ttotal" value="<?php echo $ttotal ?>">
                <input type="hidden" name="ctotal" value="<?php echo $ctotal ?>">
                <?php
            }
            ?>
            <li><input type="submit" name="enviar"></li>
        </ul>
    </form>
    <?php
}
?>


</body>
</html>