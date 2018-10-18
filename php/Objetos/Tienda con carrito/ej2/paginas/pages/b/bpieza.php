<div class="centradohorizontal">
    <form method="post">
        <div class="form-group">
            <label for="campo">Campo donde buscar:</label>
            <select name="campo" id="campo" class="custom-select" onchange="mpieza(this.value)">
                <option value="NOMPIEZA">Nombre</option>
                <option value="NUMPIEZA">Numero</option>
                <option value="PRECIOVENT">Precio</option>
            </select>
        </div>

        <div id="opcionales">
            <div class="form-group">
                <label>Nombre: </label>
                <input type="text" name="inombre" class="form-controls"/>
            </div>
        </div>


        <input type="submit" name="buscar" id="submit" class="btn btn-default" value="Buscar">
    </form>
</div>
<hr/>
<?php
if (isset($_REQUEST["borrar"])) {
    delete($conexion, "PIEZA", "NUMPIEZA='" . $_REQUEST["borrar"] . "'");
}
$sentencia = "SELECT * FROM PIEZA WHERE 1 = 1";

if (isset($_REQUEST["buscar"])) {/* Si se ha introducido un filtro de busqueda */
    $campo = $_REQUEST["campo"];
    $sentencia .= " AND ";

    if (isset($_REQUEST["inombre"])) {
        $texto = "NOMPIEZA like '%" . $_REQUEST["inombre"] . "%'";

    } else if (isset($_REQUEST["inumero"])) {
        $texto = "NUMPIEZA like '" . $_REQUEST["inumero"] . "'";

    } else if (isset($_REQUEST["imenor"])) {
        $menor = $_REQUEST["imenor"];
        $mayor = $_REQUEST["imayor"];
        if ($menor > $mayor) {
            $aux = $menor;
            $menor = $mayor;
            $mayor = $aux;
        }
        $texto = "PRECIOVENT BETWEEN $menor AND $mayor";
    }
    $sentencia .= $texto;
}

/* Se ejecuta siempre */

$resultado = $conexion->query($sentencia);

if ($conexion->affected_rows >= 1) {

    echo " <div>
                <table class=' table table-stripped'> ";

    echo "<tr class='thead'>
                <th> Numero </th> 
                <th> Nombre </th> 
                <th> Precio </th>
                <th> Acciones </th>
              </tr > ";

    while ($fila = $resultado->fetch_assoc()) {
        $borrrar = $fila["NUMPIEZA"];
        echo " <tr>
                    <td> $borrrar </td >
                    <td> " . $fila["NOMPIEZA"] . " </td >
                    <td> " . $fila["PRECIOVENT"] . " </td >";

        echo "<td>";
        if ((!existeRegistroSimple($conexion, "PRECIOSUM", "NUMPIEZA='$borrrar'") && (!existeRegistroSimple($conexion, "LINPED", "NUMPIEZA='$borrrar'") && (!existeRegistroSimple($conexion, "INVENTARIO", "NUMPIEZA='$borrrar'"))))) {
            echo "<a href='inicio.php?page=b/bpieza&borrar=$borrrar'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
        } else {
            echo "<i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>";
        }
        if (!existeRegistroSimple($conexion, "LINPED", "NUMPIEZA='$borrrar'") && !existeRegistroSimple($conexion, "LINPED", "NUMPIEZA='$borrrar'")) {
            echo "<a href='inicio.php?page=u/upieza&NUMPIEZA=" . $fila["NUMPIEZA"] . "&update=true'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>";
        } else {
            echo "<i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>";
        }

        echo "</td>
        </tr > ";

    }

    echo "</table >
            </div > ";

} else {
    echo "Sin resultados";
}

?>