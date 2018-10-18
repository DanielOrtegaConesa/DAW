<?php
include "funciones.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <meta name="description" content="Mi pagina">
    <meta name="author" content="Dani">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
if (!isset($_GET["fecha"])) {
    ?>
    <form>
        Fecha:<input type="text" name="fecha" placeholder="dd/mm/aaaa">
        <input type="submit">
    </form>
    <?php
}
?>

<?php
if (isset($_GET["fecha"])) {
    $fecha = $_GET["fecha"];

    $dia = substr($fecha, 0, 2);

    if (esnumero($dia)) {
    } else {
        $dia = "0" . $dia;
        $dia = substr($dia, 0, 2);
        $fecha = "0" . $fecha;
    }


    $mes = substr($fecha, 3, 2);
    if (esnumero($mes)) {
    } else {
        $mes = "0" . $mes;
        $mes = substr($mes, 0, 2);
    }

    $anyo = substr($fecha, 6, 4);
    if (strlen($anyo) < 4) {
        $anyo = "20" . $anyo;
        $anyo = str_replace("/", "", $anyo);
    }
    if(strlen($anyo)==3){
        $anyo = substr($fecha, 5, 4);
        if (strlen($anyo) < 4) {
            $anyo = "20" . $anyo;
            $anyo = str_replace("/", "", $anyo);
        }
    }

    if (strlen($anyo) != 4 ) {
        $anyo = substr($fecha, 5, 4);
        $anyo = str_replace("/", "", $anyo);
    }


    echo "<br/>";
    echo "Fecha introducida: " . $fecha;
    echo "<br/>";
    echo "Dia obtenido: " . $dia;
    echo "<br/>";
    echo "Mes obtenido: " . $mes;
    echo "<br/>";
    echo "Año obtenido: " . $anyo;
    echo "<br/>";

    if (!esnumero($fecha) && esnumero($dia) && esnumero($mes) && esnumero($anyo)) {
        $correcto = true;
        if ($dia <= 0 || $dia >= 32) {
            $correcto = false;
            echo "El dia tiene que estar entre 1 y 31";
        }
        if ($mes <= 0 || $mes >= 13) {
            $correcto = false;
            echo "El mes tiene que estar entre 1 y 12";
        }
        if ($anyo <= 1899 || $anyo >= 2018) {
            $correcto = false;
            echo "El año tiene que estar entre 1900 y 2017";
        }

        if ($dia >= 30 && $mes == 2) {
            $correcto = false;
        }
        if ($correcto) {
            echo "Resultado: la fecha es correcta";
        } else {

        }

    } else {
        echo "Formato incorrecto, el formato correcto es dd/mm/aaaa";
    }
}
?>
</body>
</html>
