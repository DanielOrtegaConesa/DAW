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
            <?php if (!isset($_POST["vendedor"])) { ?>

                <form method="post">
                    <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
                    <select name="vendedor">
                        <option value="0">Vendedor 1</option>
                        <option value="1">Vendedor 2</option>
                        <option value="2">Vendedor 3</option>
                        <option value="3">Vendedor 4</option>
                        <option value="4">Vendedor 5</option>
                        <option value="5">Vendedor 6</option>
                        <option value="6">Vendedor 7</option>
                        <option value="7">Vendedor 8</option>
                        <option value="8">Vendedor 9</option>
                        <option value="9">Vendedor 10</option>
                    </select>
                    <input type="submit" value="Mostrar">
                </form>

            <?php } else {
                $vendedor = $_POST["vendedor"];
                $suma = 0;

                echo "<table border='1'><tr>";
                echo "<th>&nbsp;Producto&nbsp;</th><th>&nbsp;Ventas&nbsp;</th>";
                for ($c = 0; $c < 10; $c++) {
                    if (($c%2)==0){
                        echo "<tr class='par'>";
                    }else{
                        echo "<tr class='impar'>";
                    }
                    echo "<td>" . ($c + 1) . "</td><td>" . $negocio[$vendedor][$c] . "</td></tr>";
                    $suma += $negocio[$vendedor][$c];
                }
                echo "</tr></table><br/>";
                echo "</div>";
                echo "<div class='izquierda'>";
                echo "El resultado de todas las ventas del vendedor es: " . $suma;
            } ?>
        </div>
    </div>


    <?php
} else {
    echo "Ha ocurrido un error.";
}
?>

</body>
</html>