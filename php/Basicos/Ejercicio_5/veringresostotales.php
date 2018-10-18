<?php
include "funciones.php";
include "funcionesEspecificas.php";
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
if (isset($_POST["negocioencadena"])) {
    $negocio = cadenaurl_a_array($_POST["negocioencadena"]);

    ?>
    <div class="top">
        <?php ponermenu($negocio); ?>
    </div>

    <div class="principal">

        <div class="derecha">
            <?php
            echo "<table border='1'>";
            echo "<th>Vendedor</th><th>Ventas</th>";
            $suma = 0;
            for ($v = 0; $v < 18; $v++) {
                for ($p = 0; $p < 10; $p++) {
                    $suma += $negocio[$v][$p];

                }
                if (($v % 2 == 0)) {
                    echo "<tr class='par'>";
                } else {
                    echo "<tr class='impar'>";
                }
                echo "<td>" . ($v + 1) . "</td><td>" . $suma . "</td>";
                echo "</tr>";
                $suma = 0;
            }
            echo "<table>";
            ?>
        </div>
        <div class="izquierda">
            <?php
            echo "<table border='1'>";
            echo "<th>Producto</th><th>Ventas</th>";
            $suma = 0;
            for ($p = 0; $p < 10; $p++) {
                for ($v = 0; $v < 18; $v++) {
                    $suma += $negocio[$v][$p];
                }
                if (($p % 2 )== 0) {
                    echo "<tr class='par'>";
                } else {
                    echo "<tr class='impar'>";
                }
                echo "<td>" . ($p + 1) . "</td><td>" . $suma . "</td>";
                $suma = 0;
            }
            ?>
        </div>
    </div>


    <?php
} else {
    echo "Ha ocurrido un error.";
}
?>

</body>
</html>