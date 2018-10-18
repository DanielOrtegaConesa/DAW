<?php
if (isset($_REQUEST["rellenado"])) {
    $antiguaNUMPIEZA = $_REQUEST["antiguaNUMPIEZA"];

    $NUMPIEZA = $_REQUEST["NUMPIEZA"];

    $NOMPIEZA = $_REQUEST["NOMPIEZA"];
    $PRECIOVENT = $_REQUEST["PRECIOVENT"];

    $notificaciones = [];

    //control de errores
    //numpieza
    if($antiguaNUMPIEZA!=$NUMPIEZA) {
        if (existeRegistroSimple($conexion, "PIEZA", "NUMPIEZA='$NUMPIEZA'")) $notificaciones[] = "Ese numero de pieza ya existe";
    }

   //nompieza
    // ningun control dado que he observado que algunas piezas no tienen nombre en la bd original por lo que que tengan nombre no es un requisito

    //Preciovent
    if (strlen($PRECIOVENT)>11) $notificaciones[] = "Precio fuera de los limites";
    if ($PRECIOVENT < 0) $notificaciones[] = "El precio no puede ser inferior a 0, como mucho gratuito(0), de lo contrario deberiamos dinero";
    if (!esnumero($PRECIOVENT)) $notificaciones[] = "Descuento debe ser solo numerico";

    if (count($notificaciones) != 0) {
        header("location:inicio.php?update=true&page=u/upieza&NUMPIEZA=$NUMPIEZA&notificaciones=" . array_a_cadenaurl($notificaciones));
    } else {
        $adatos = arrayDatos("NUMPIEZA,,NOMPIEZA,,PRECIOVENT", "$NUMPIEZA,,$NOMPIEZA,,$PRECIOVENT");
        update($conexion, "PIEZA", $adatos, "NUMPIEZA='$antiguaNUMPIEZA'");
        header("location:inicio.php?page=b/bpieza");
    }
}


if (isset($_REQUEST["update"])) {

    if (isset($_REQUEST["notificaciones"])) {
        $notificaciones = cadenaurl_a_array($_REQUEST["notificaciones"]);
        echo "<div class=\"alert alert-warning\" role=\"alert\">";
        echo "<br/>";
        foreach ($notificaciones as $indice => $notificacion) {
            echo $notificacion . "<br/>";
        }
        echo "</div>";
    }

    $NUMPIEZA = $_REQUEST["NUMPIEZA"];
    $campos = select($conexion, "*", "PIEZA", "NUMPIEZA='$NUMPIEZA'")

    ?>

    <form method="post">
        <input type="hidden" name="antiguaNUMPIEZA" value="<?= $NUMPIEZA ?>">
        <div class="form-group">
            <div class="form-group">
                <label>Numero de pieza: </label>
                <input type="text" name="NUMPIEZA" value="<?=$campos["NUMPIEZA"]?>">
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Nombre: </label>
                <input type="text" name="NOMPIEZA" class="form-controls" value="<?= $campos["NOMPIEZA"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Precio Venta: </label>
                <input type="number" name="PRECIOVENT" class="form-controls" value="<?= $campos["PRECIOVENT"] ?>"/>
            </div>
        </div>

        <input type="submit" name="rellenado" class="btn btn-default" value="Actualizar">
    </form>

    <?php
}

?>