<!--<div class="container">
    <div class="notice notice-success">
        <strong>Recuerda: </strong> Si en el boton de eliminar aparece  <i class="fa fa-frown-o" aria-hidden="true"> es porque no puedes eliminar a este vendedor
    </div>
</div>-->

<div class="centradohorizontal">
    <form method="post">
        <div class="form-group">
            <label for="campo">Campo donde buscar:</label>
            <select name="campo" id="campo" class="custom-select" onchange="mvend(this.value)">
                <option value="NUMVEND">Numero</option>
                <option value="NOMVEND">Nombre</option>
                <option value="NOMBRECOMER">Comercio</option>
                <option value="TELEFONO">Telefono</option>
                <option value="CALLE">Calle</option>
                <option value="CIUDAD">Ciudad</option>
                <option value="PROVINCIA">Provincia</option>
                <option value="COD_POSTAL">Codigo Postal</option>
            </select>
        </div>

        <div id="opcionales">
            <div class="form-group">
                <label>Numero: </label>
                <input type="number" name="dato" class="form-controls"/>
            </div>
        </div>

        <input type="submit" name="buscar" id="submit" class="btn btn-default" value="Buscar">
    </form>
</div>

<hr/>

<?php
if (isset($_REQUEST["borrar"])) {
    delete($conexion, "VENDEDOR", "NUMVEND=" . $_REQUEST["borrar"]);
}

$sentencia = "
SELECT * FROM VENDEDOR WHERE 1=1";

if (isset($_REQUEST["buscar"])) {// Si se ha introducido un filtro de busqueda
    if ($_REQUEST["dato"] != "") {
        $campo = $_REQUEST["campo"];
        $sentencia .= " AND ";

        $dato = $_REQUEST["dato"];

        switch ($campo) {
            case "NUMVEND":
                $sentencia .= "NUMVEND = '$dato'";
                break;

            case "NOMVEND":
                $sentencia .= "NOMVEND like '%$dato%'";
                break;

            case "NOMBRECOMER":
                $sentencia .= "NOMBRECOMER like '%$dato%'";
                break;

            case "TELEFONO":
                $sentencia .= "TELEFONO like '%$dato%'";
                break;

            case "CALLE":
                $sentencia .= "CALLE like '%$dato'%";
                break;

            case "CIUDAD":
                $sentencia .= "CIUDAD like '%$dato%'";
                break;

            case "PROVINCIA":
                $sentencia .= "PROVINCIA like '%$dato%'";
                break;

            case "COD_POSTAL":
                $sentencia .= "COD_POSTAL like '%$dato%'";
                break;

        }
    }
}

$resultado = $conexion->query($sentencia);

if ($conexion->affected_rows >= 1) {

    echo " <div>
                <table class=' table table-stripped'> ";

    echo "<tr class='thead'>
                <th>Numero</th>
                <th>Nombre</th>
                <th>Comercio</th>        
                <th>Telefono</th>        
                <th>Calle</th>
                <th>Ciudad</th>
                <th>Provincia</th>
                <th>Codigo Postal</th>
                <th>Acciones</th>
              </tr > ";

    while ($fila = $resultado->fetch_assoc()) {
        echo " <tr>
                    <td> " . $fila["NUMVEND"] . " </td>
                    <td> " . $fila["NOMVEND"] . " </td>
                    <td> " . $fila["NOMBRECOMER"] . " </td>
                    <td> " . $fila["TELEFONO"] . " </td>
                    <td> " . $fila["CALLE"] . " </td>
                    <td> " . $fila["CIUDAD"] . " </td>
                    <td> " . $fila["PROVINCIA"] . " </td>
                    <td> " . $fila["COD_POSTAL"] . " </td>
                    <td>";
        //Borrado

        if (!existeRegistroSimple($conexion, "PRECIOSUM", "NUMVEND=" . $fila["NUMVEND"]) && !existeRegistroSimple($conexion, "PEDIDO", "NUMVEND=" . $fila["NUMVEND"] . "")) {
            echo "<a href='inicio.php?page=b/bvendedor&borrar=" . $fila["NUMVEND"] . "'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
        } else {
            echo "<i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>";
        }

        //Actualizacion
        echo "<a href='inicio.php?page=u/uvendedor&NUMVEND=" . $fila["NUMVEND"] . "&update=true'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>";


        echo "</td>
            </tr > ";
    }

    echo "</table >
            </div > ";
} else {
    echo "Sin resultados";
}


?>