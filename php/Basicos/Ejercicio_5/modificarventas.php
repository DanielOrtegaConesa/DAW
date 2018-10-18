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
                        <option value="10">Vendedor 11</option>
                        <option value="11">Vendedor 12</option>
                        <option value="12">Vendedor 13</option>
                        <option value="13">Vendedor 14</option>
                        <option value="14">Vendedor 15</option>
                        <option value="15">Vendedor 16</option>
                        <option value="16">Vendedor 17</option>
                        <option value="17">Vendedor 18</option>
                    </select>
                    <select name="producto">
                        <option value="0">Producto 1</option>
                        <option value="1">Producto 2</option>
                        <option value="2">Producto 3</option>
                        <option value="3">Producto 4</option>
                        <option value="4">Producto 5</option>
                        <option value="5">Producto 6</option>
                        <option value="6">Producto 7</option>
                        <option value="7">Producto 8</option>
                        <option value="8">Producto 9</option>
                        <option value="9">Producto 10</option>
                    </select>
                    <input type="text" name="valor" placeholder="Introduzca el nuevo valor">
                    <input type="submit" value="Modificar">
                </form>

            <?php } else {
                $vendedor = $_POST["vendedor"];
                $producto = $_POST["producto"];
                $valor = $_POST["valor"];
                if (strlen($valor) == 0) {
                    $valor = 0;
                }
                if ($valor < 0) {
                    $valor = 0;
                }
                echo "Estas apunto de cambiar el valor " . $negocio[$vendedor][$producto] . " por " . $valor;
                $negocio = cadenaurl_a_array($_POST["negocioencadena"]);
                $negocio[$vendedor][$producto] = $valor;

                ?>
                <form action="inicio.php" method="post">
                    <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
                    <input type="submit" value="Confirmar">
                </form>
                <?php


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