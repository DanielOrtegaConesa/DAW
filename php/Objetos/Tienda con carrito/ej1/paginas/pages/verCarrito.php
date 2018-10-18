<?php
$carrito = $_SESSION["carrito"];

if (isset($_REQUEST["accion"])) {
    $accion = $_REQUEST["accion"];

    switch ($accion) {
        case "bpieza":
            $carrito->delPieza($_REQUEST["NUMPIEZA"]);
            break;
        case "bcarrito":
            $carrito->vaciar();
            break;
        case "ccantidad":
            $NUMPIEZA = $_REQUEST["NUMPIEZA"];
            $ncantidad = $_REQUEST["cantidad"];
            if ($ncantidad > 0) {
                $pieza = $carrito->getPieza($NUMPIEZA);
                $pieza->setCantidad($ncantidad);
            }
            break;
        case "rpedido":
            realizarpedido($conexion);
            $_SESSION["carrito"] = new Carrito();
            header("location:inicio.php?page=verCarrito");
            break;
    }
}

?>
    <div>
        <div class="container">
            <div class="notice notice-success">
                <strong>Recuerda: </strong> Al cambiar la cantidad de un producto debes pulsar <i class='fa fa-check'
                                                                                                  aria-hidden='true'></i>
                para confirmarlo
            </div>
        </div>


        <table class=' table table-stripped'>
            <tr class='thead-dark'>
                <th> Numero</th>
                <th> Nombre</th>
                <th> Precio</th>
                <th> Cantidad</th>
                <th> Eliminar</th>
            </tr>

            <?php
            $total = 0;

            foreach ($carrito->getPiezas() as $indice => $pieza) {
                $sentencia = "SELECT * FROM pieza WHERE NUMPIEZA = '$indice'";
                $resultado = $conexion->query($sentencia);

                $fila = $resultado->fetch_assoc();
                $NUMPIEZA = $fila["NUMPIEZA"];
                $NOMPIEZA = $fila["NOMPIEZA"];
                $PRECIOVENT = $fila["PRECIOVENT"];
                $carrito->getPieza($NUMPIEZA)->setPRECIOVENT($PRECIOVENT);
                $cantidad = $carrito->getPieza($indice)->getCantidad();

                $total += $PRECIOVENT * $cantidad;
                ?>
                <tr>

                    <td><?= $NUMPIEZA ?></td>
                    <td><?= $NOMPIEZA ?></td>
                    <td><?= $PRECIOVENT ?></td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="NUMPIEZA" value="<?= $NUMPIEZA ?>">
                            <input type="hidden" name="accion" value="ccantidad">

                            <input type='number' name="cantidad" value='<?= $cantidad ?>'>

                            <label for="env<?=$NUMPIEZA?>"><i class='fa fa-check' aria-hidden='true'></i></label>
                            <input type="submit" id="env<?=$NUMPIEZA?>" class="d-none">
                        </form>
                    </td>

                    <td>
                        <a href='inicio.php?page=verCarrito&accion=bpieza&NUMPIEZA=<?= $NUMPIEZA ?>'>
                            <i class="fa fa-2x fa-trash" aria-hidden="true"> </i>
                        </a>
                    </td>

                </tr>
                <?php

            }
            ?>
            <tr>
                <td> <strong>Total:</strong> <?=$total?></td>
            </tr>
        </table>
    </div>
    <a href="inicio.php?page=verCarrito&accion=rpedido" class="btn btn-primary"> Realizar Pedido </a>
    <a href="inicio.php?page=verCarrito&accion=bcarrito" class="btn btn-danger"> Borrar Carrito </a>
<?php
