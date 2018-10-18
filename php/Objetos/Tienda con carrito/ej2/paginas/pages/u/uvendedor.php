<?php
if (isset($_REQUEST["rellenado"])) {
    $NUMVENDoriginal = $_REQUEST["NUMVENDoriginal"];
    $NUMVEND = $_REQUEST["NUMVEND"];
    $NOMVEND = $_REQUEST["NOMVEND"];
    $NOMBRECOMER = $_REQUEST["NOMBRECOMER"];
    $TELEFONO = $_REQUEST["TELEFONO"];
    $CALLE = $_REQUEST["CALLE"];
    $CIUDAD = $_REQUEST["CIUDAD"];
    $PROVINCIA = $_REQUEST["PROVINCIA"];
    $COD_POSTAL = $_REQUEST["COD_POSTAL"];

    $notificaciones = [];

    //control de errores

    //numvend
    if($NUMVENDoriginal!=$NUMVEND) {
        if (existeRegistroSimple($conexion, "VENDEDOR", "NUMVEND=$NUMVEND")) $notificaciones[] = "Ya existe ese numero de vendedor";
    }
    if (strlen($NUMVEND) == 0) $notificaciones[] = "El numero del vendedor debe contener datos";
    if ($NUMVEND > 32767) $notificaciones[] = "El numero del vendedor debe ser inferior a 32767";
    if ($NUMVEND < 0) $notificaciones[] = "El numero del vendedor debe ser superior a 0";
    if (!esnumero($NUMVEND)) $notificaciones[] = "El numero del vendedor debe ser un numero";
    //nomvend
    if (strlen($NOMVEND) == 0) $notificaciones[] = "Debes introducir texto en el nombre del vendedor";
    if (strlen($NOMVEND) > 30) $notificaciones[] = "El nombre del vendedor no debe tener mas de 30 caracteres";

    //telefono
    if (!esnumero($TELEFONO)) $notificaciones[] = "El telefono debe ser solo numerico";
    if (strlen($TELEFONO) != 9 && strlen($TELEFONO) != 0) $notificaciones[] = "El telefono debe tener 9 numeros";

    //calle
    if (strlen($CALLE) > 30) $notificaciones[] = "La calle debe tener como maximo 30 caracteres";

    //ciudad
    if (strlen($CIUDAD) > 20) $notificaciones[] = "La ciudad debe tener como maximo 20 caracteres";

    //provincia
    if (strlen($PROVINCIA) > 20) $notificaciones[] = "La provincia debe tener como maximo 20 caracteres";

    //cp
    if (strlen($COD_POSTAL) != 5 && strlen($COD_POSTAL) != 0) $notificaciones[] = "El codigo postal debe tener 5 numeros";
    if (!esnumero($COD_POSTAL)) $notificaciones[] = "El codigo postal debe ser solo numerico";

    if (count($notificaciones) != 0) {
        header("location:inicio.php?update=true&page=u/uvendedor&NUMVEND=$NUMVENDoriginal&notificaciones=" . array_a_cadenaurl($notificaciones));
    } else {
        $adatos = arrayDatos("NUMVEND,,NOMVEND,,NOMBRECOMER,,TELEFONO,,CALLE,,CIUDAD,,PROVINCIA,,COD_POSTAL", "$NUMVEND,,$NOMVEND,,$NOMBRECOMER,,$TELEFONO,,$CALLE,,$CIUDAD,,$PROVINCIA,,$COD_POSTAL");
        update($conexion, "VENDEDOR", $adatos, "NUMVEND='$NUMVENDoriginal'");
        header("location:inicio.php?page=b/bvendedor");
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

    $NUMVEND = $_REQUEST["NUMVEND"];
    $campos = select($conexion, "*", "VENDEDOR", "NUMVEND='$NUMVEND'");
    ?>

    <form method="post">
        <input type="hidden" name="NUMVENDoriginal" value="<?=$NUMVEND?>">
        <div class="form-group">
            <div class="form-group">
                <label>Numero del vendedor: </label>
                <input type="number" name="NUMVEND" class="form-controls" value="<?= $NUMVEND ?>"/>
                *
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Nombre del vendedor: </label>
                <input type="text" name="NOMVEND" class="form-controls" value="<?= $campos["NOMVEND"] ?>"/>
                *
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Nombre del comercio: </label>
                <input type="text" name="NOMBRECOMER" class="form-controls" value="<?= $campos["NOMBRECOMER"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Telefono: </label>
                <input type="text" name="TELEFONO" class="form-controls" value="<?= $campos["TELEFONO"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Calle: </label>
                <input type="text" name="CALLE" class="form-controls" value="<?= $campos["CALLE"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Ciudad: </label>
                <input type="text" name="CIUDAD" class="form-controls" value="<?= $campos["CIUDAD"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Provincia: </label>
                <input type="text" name="PROVINCIA" class="form-controls" value="<?= $campos["PROVINCIA"] ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Codigo Postal: </label>
                <input type="text" name="COD_POSTAL" class="form-controls" value="<?= $campos["COD_POSTAL"] ?>"/>
            </div>
        </div>

        <input type="submit" name="rellenado" class="btn btn-default" value="Actualizar">
    </form>

    <?php

}