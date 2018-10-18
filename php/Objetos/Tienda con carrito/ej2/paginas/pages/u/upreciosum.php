<?php
if (isset($_REQUEST["rellenado"])) {
    $antiguaNUMPIEZA = $_REQUEST["antiguaNUMPIEZA"];
    $antiguoNUMVEND = $_REQUEST["antiguoNUMVEND"];

    $NUMPIEZA = $_REQUEST["NUMPIEZA"];
    $NUMVEND = $_REQUEST["NUMVEND"];

    $PRECIOUNIT = $_REQUEST["PRECIOUNIT"];//selectundato($conexion, "PRECIOVENT", "PIEZA", "NUMPIEZA='$NUMPIEZA'");
    $DIASSUM = $_REQUEST["DIASSUM"];
    $DESCUENTO = $_REQUEST["DESCUENTO"];

    $notificaciones = [];

    //control de errores
    //numpieza
    if (!existeRegistroSimple($conexion, "PIEZA", "NUMPIEZA='$NUMPIEZA'")) $notificaciones[] = "Error en la seleccion de pieza";
    // no se hacen mas controles debido a que se comrpueba la procedencia

    //numvend
    if (!existeRegistroSimple($conexion, "VENDEDOR", "NUMVEND=$NUMVEND")) $notificaciones[] = "Error en la seleccion de vendedor";
    // no se hacen mas controles debido a que se comrpueba la procedencia

    //preciounit
    if($PRECIOUNIT<0) $notificaciones[]="El precio no puede ser inferior a 0";
    if(strlen($PRECIOUNIT)>11) $notificaciones[]="El precio como maximo debe tener 11 numeros";
    if(!esnumero($PRECIOUNIT)) $notificaciones[]="El precio debe ser unicamente numerico";

    //diassum
    if ($DIASSUM > 32767) $notificaciones[] = "Dias sum debe ser inferior a 32767";
    if ($DIASSUM < 0) $notificaciones[] = "Dias sum debe ser superior a 0";
    if (!esnumero($DIASSUM)) $notificaciones[] = "Dias sum debe ser solo numerico";

    //Descuento
    if ($DESCUENTO > 32767) $notificaciones[] = "Descuento debe ser inferior a 32767";
    if ($DESCUENTO < 0) $notificaciones[] = "Descuento debe ser superior a 0";
    if (!esnumero($DESCUENTO)) $notificaciones[] = "Descuento debe ser solo numerico";

    if (count($notificaciones) != 0) {
        header("location:inicio.php?update=true&page=u/upreciosum&NUMPIEZA=$NUMPIEZA&NUMVEND=$NUMVEND&notificaciones=" . array_a_cadenaurl($notificaciones));
    } else {
        $adatos = arrayDatos("NUMPIEZA,,NUMVEND,,PRECIOUNIT,,DIASSUM,,DESCUENTO", "$NUMPIEZA,,$NUMVEND,,$PRECIOUNIT,,$DIASSUM,,$DESCUENTO");
        update($conexion, "PRECIOSUM", $adatos, "NUMPIEZA='$antiguaNUMPIEZA' AND NUMVEND='$antiguoNUMVEND'");
        header("location:inicio.php?page=b/bpreciosum");
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
    $NUMVEND = $_REQUEST["NUMVEND"];
    $campos = select($conexion, "*", "PRECIOSUM", "NUMPIEZA='$NUMPIEZA' AND NUMVEND = '$NUMVEND'")

    ?>

    <form method="post">
        <input type="hidden" name="antiguaNUMPIEZA" value="<?= $NUMPIEZA ?>">
        <input type="hidden" name="antiguoNUMVEND" value="<?= $NUMVEND ?>">
        <div class="form-group">

            <div class="form-group">
                <label>Numero de pieza: </label>
                <select name="NUMPIEZA">
                    <?php
                    $sentencia = "SELECT * FROM PIEZA";
                    $resultado = $conexion->query($sentencia);
                    while ($fila = $resultado->fetch_assoc()) {

                        if ($fila["NUMPIEZA"] == $NUMPIEZA) {
                            echo "<option value='" . $fila["NUMPIEZA"] . "' selected>" . $fila["NUMPIEZA"] . " - " . $fila["NOMPIEZA"] . "</option>";
                        } else {
                            if (!existeRegistroSimple($conexion, "PRECIOSUM", "NUMVEND=$NUMVEND AND NUMPIEZA = '" . $fila["NUMPIEZA"] . "'")) {

                                echo "<option value='" . $fila["NUMPIEZA"] . "'>" . $fila["NUMPIEZA"] . " - " . $fila["NOMPIEZA"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="form-group">
            <label>Numero de vendedor: </label>
            <select name="NUMVEND">
                <?php
                $sentencia = "SELECT * FROM VENDEDOR";
                $resultado = $conexion->query($sentencia);

                while ($fila = $resultado->fetch_assoc()) {
                    if ($fila["NUMVEND"] == $NUMVEND) {
                        echo "<option value='" . $fila["NUMVEND"] . "' selected>" . $fila["NUMVEND"] . " - " . $fila["NOMVEND"] . "</option>";
                    } else {
                        if (!existeRegistroSimple($conexion, "PRECIOSUM", "NUMVEND=" . $fila["NUMVEND"] . " AND NUMPIEZA = '$NUMPIEZA'")) {
                            echo "<option value='" . $fila["NUMVEND"] . "'>" . $fila["NUMVEND"] . " - " . $fila["NOMVEND"] . "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Precio Unidad: </label>
                <input type="text" name="PRECIOUNIT" value="<?= $campos["PRECIOUNIT"] ?>">
            </div>
        </div>


        <div class="form-group">
            <div class="form-group">
                <label>Dias sum: </label>
                <input type="number" name="DIASSUM" class="form-controls" value="<?= $campos["DIASSUM"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Descuento: </label>
                <input type="number" name="DESCUENTO" class="form-controls" value="<?= $campos["DESCUENTO"] ?>"/>
            </div>
        </div>

        <input type="submit" name="rellenado" class="btn btn-default" value="Actualizar">
    </form>

    <?php
}

?>