<?php
// Recogida y comprobacion de datos
if (isset($_REQUEST["rellenado"])) {
    $NUMPIEZA = $_REQUEST["NUMPIEZA"];
    $NUMVEND = $_REQUEST["NUMVEND"];
    $PRECIOUNIT = selectundato($conexion, "PRECIOVENT", "PIEZA", "NUMPIEZA=$NUMPIEZA");
    $DIASSUM = $_REQUEST["DIASSUM"];
    $DESCUENTO = $_REQUEST["DESCUENTO"];

    $notificaciones = [];

    //control de errores


    //Clave no repetida
    if(existeRegistroSimple($conexion,"PRECIOSUM","NUMPIEZA='$NUMPIEZA' AND NUMVEND = $NUMVEND"))$notificaciones[]="No se puede añadir dado que ya existe este registro";

    //numpieza
    if (!existeRegistroSimple($conexion, "PIEZA", "NUMPIEZA=$NUMPIEZA")) $notificaciones[] = "Error en la seleccion de pieza";
    // no se hacen mas controles debido a que se comrpueba la procedencia

    //numvend
    if (!existeRegistroSimple($conexion, "VENDEDOR", "NUMVEND=$NUMVEND")) $notificaciones[] = "Error en la seleccion de vendedor";
    // no se hacen mas controles debido a que se comrpueba la procedencia

    //preciounit
    // No hay error posible dado que se saca de la bd

    //diassum
    if ($DIASSUM > 32767) $notificaciones[] = "Dias sum debe ser inferior a 32767";
    if ($DIASSUM < 0) $notificaciones[] = "Dias sum debe ser superior a 0";
    if (!esnumero($DIASSUM)) $notificaciones[] = "Dias sum debe ser solo numerico";

    //Descuento
    if ($DESCUENTO > 32767) $notificaciones[] = "Descuento debe ser inferior a 32767";
    if ($DESCUENTO < 0) $notificaciones[] = "Descuento debe ser superior a 0";
    if (!esnumero($DESCUENTO)) $notificaciones[] = "Descuento debe ser solo numerico";

    if (count($notificaciones) != 0) {
        $datos = [];
        $datos[] = $NUMPIEZA;
        $datos[] = $NUMVEND;
        $datos[] = $DIASSUM;
        $datos[] = $DESCUENTO;
        header("location:inicio.php?page=a/apreciosum&notificaciones=" . array_a_cadenaurl($notificaciones) . "&datos=" . array_a_cadenaurl($datos));
    } else {
        insert($conexion, "PRECIOSUM", "'$NUMPIEZA','$NUMVEND','$PRECIOUNIT','$DIASSUM','$DESCUENTO'");
        $notificaciones[] = "Añadido correctamente";
        header("location:inicio.php?page=a/apreciosum&notificaciones=" . array_a_cadenaurl($notificaciones));
    }

}


$NUMPIEZA = "";
$NUMVEND = "";
$PRECIOUNIT = "";
$DIASSUM = "";
$DESCUENTO = "";
?>

    <div id="errores">
        <?php

        if (isset($_REQUEST["notificaciones"])) {

            $notificaciones = cadenaurl_a_array($_REQUEST["notificaciones"]);
            echo "<div class=\"alert alert-warning\" role=\"alert\">";
            echo "<br/>";
            foreach ($notificaciones as $indice => $notificacion) {
                echo $notificacion . "<br/>";
            }
            echo "</div>";

            if (isset($_REQUEST["datos"])) {
                $datos = cadenaurl_a_array($_REQUEST["datos"]);
                foreach ($datos as $indice => $dato) {//asignacion de los datos
                    switch ($indice) {
                        case 0:
                            $NUMPIEZA = $dato;
                            break;
                        case 1:
                            $NUMVEND = $dato;
                            break;
                        case 2:
                            $DIASSUM = $dato;
                            break;
                        case 3:
                            $DESCUENTO = $dato;
                            break;
                    }
                }
            }
        }
        ?>
    </div>

    <!--  FORMULARIO QUE SE MUESTRA SIEMPRE -->
    <form method="post">

        <div class="form-group">
            <div class="form-group">
                <label>Numero de pieza: </label>
                <select name="NUMPIEZA" class="form-controls">
                    <?php
                    $sql = "Select NUMPIEZA,NOMPIEZA FROM PIEZA";
                    $resultado = $conexion->query($sql);
                    while (($fila = $resultado->fetch_row())) {
                        echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila[1] . "</option>";
                    }
                    ?>
                </select>

                *
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Numero del vendedor: </label>
                <select name="NUMVEND" class="form-controls">
                    <?php
                    $sql = "Select NUMVEND,NOMVEND FROM VENDEDOR";
                    $resultado = $conexion->query($sql);
                    while (($fila = $resultado->fetch_row())) {
                        echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila[1] . "</option>";
                    }
                    ?>
                </select>
                *
            </div>
        </div>


        <div class="form-group">
            <div class="form-group">
                <label>Dias sum: </label>
                <input type="number" name="DIASSUM" class="form-controls" value="<?= $DIASSUM ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Descuento: </label>
                <input type="number" name="DESCUENTO" class="form-controls" value="<?= $DESCUENTO ?>"/>
            </div>
        </div>

        <input type="submit" name="rellenado" class="btn btn-default" value="Añadir">
    </form>

<?php
?>