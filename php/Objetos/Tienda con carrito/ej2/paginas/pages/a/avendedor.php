<?php
// Recogida y comprobacion de datos
if (isset($_REQUEST["rellenado"])) {
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
    if (existeRegistroSimple($conexion, "VENDEDOR", "NUMVEND=$NUMVEND")) $notificaciones[] = "Ya existe ese numero de vendedor";
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
        $datos = [];
        $datos[] = $NUMVEND;
        $datos[] = $NOMVEND;
        $datos[] = $NOMBRECOMER;
        $datos[] = $TELEFONO;
        $datos[] = $CALLE;
        $datos[] = $CIUDAD;
        $datos[] = $PROVINCIA;
        $datos[] = $COD_POSTAL;
        header("location:inicio.php?page=a/avendedor&notificaciones=" . array_a_cadenaurl($notificaciones) . "&datos=" . array_a_cadenaurl($datos));
    } else {
        insert($conexion, "VENDEDOR", "'$NUMVEND','$NOMVEND','$NOMBRECOMER','$TELEFONO','$CALLE','$CIUDAD','$PROVINCIA','$COD_POSTAL'");

        header("location:inicio.php?page=b/bvendedor");
    }

}


$NUMVEND = "";
$NOMVEND = "";
$NOMBRECOMER = "";
$TELEFONO = "";
$CALLE = "";
$CIUDAD = "";
$PROVINCIA = "";
$COD_POSTAL = "";
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
                            $NUMVEND = $dato;
                            break;
                        case 1:
                            $NOMVEND = $dato;
                            break;
                        case 2:
                            $NOMBRECOMER = $dato;
                            break;
                        case 3:
                            $TELEFONO = $dato;
                            break;
                        case 4:
                            $CALLE = $dato;
                            break;
                        case 5:
                            $CIUDAD = $dato;
                            break;
                        case 6:
                            $PROVINCIA = $dato;
                            break;
                        case 7:
                            $COD_POSTAL = $dato;
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
                <label>Numero del vendedor: </label>
                <input type="text" name="NUMVEND" class="form-controls" value="<?= $NUMVEND ?>"/>
                *
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Nombre del vendedor: </label>
                <input type="text" name="NOMVEND" class="form-controls" value="<?= $NOMVEND ?>"/>
                *
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Nombre del comercio: </label>
                <input type="text" name="NOMBRECOMER" class="form-controls" value="<?= $NOMBRECOMER ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Telefono: </label>
                <input type="text" name="TELEFONO" class="form-controls" value="<?= $TELEFONO ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Calle: </label>
                <input type="text" name="CALLE" class="form-controls" value="<?= $CALLE ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Ciudad: </label>
                <input type="text" name="CIUDAD" class="form-controls" value="<?= $CIUDAD ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Provincia: </label>
                <input type="text" name="PROVINCIA" class="form-controls" value="<?= $PROVINCIA ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>Codigo Postal: </label>
                <input type="text" name="COD_POSTAL" class="form-controls" value="<?= $COD_POSTAL ?>"/>
            </div>
        </div>

        <input type="submit" name="rellenado" class="btn btn-default" value="Registrar">
    </form>

<?php

?>