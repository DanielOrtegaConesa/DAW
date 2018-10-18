<div class="centradohorizontal">
    <form method="post">
        <div class="form-group">
            <label for="campo">Campo donde buscar:</label>
            <select name="campo" id="campo" class="custom-select" onchange="mpsum(this.value)">
                <option value="NUMPIEZA">Numero de pieza</option>
                <option value="NUMVEND">Numero de vendedor</option>
                <option value="NOMPIEZA">Nombre de pieza</option>
                <option value="NOMVEND">Nombre de vendedor</option>
                <option value="PROVINCIA">Provincia del vendedor</option>
                <option value="rprecio">Precio</option>
            </select>
        </div>

        <div id="opcionales">
            <div class="form-group">
                <label>Numero de pieza: </label>
                <input type="text" name="NUMPIEZA" class="form-controls"/>
            </div>
        </div>

        <input type="submit" name="buscar" id="submit" class="btn btn-default" value="Buscar">
    </form>
</div>

<hr/>

<?php

if (isset($_REQUEST["BORRAR"])) {// se quiere borrar
    $NUMPIEZA = $_REQUEST["NUMPIEZA"];
    $NUMVEND = $_REQUEST["NUMVEND"];
    delete($conexion, "PRECIOSUM", "NUMPIEZA='$NUMPIEZA' AND NUMVEND = $NUMVEND");

}

$sentencia = "
SELECT * FROM PRECIOSUM PRE
INNER JOIN PIEZA PIE ON PRE.NUMPIEZA = PIE.NUMPIEZA
INNER JOIN VENDEDOR VEN ON PRE.NUMVEND = VEN.NUMVEND
WHERE 1=1";

if (isset($_REQUEST["buscar"])) {// Si se ha introducido un filtro de busqueda
    $campo = $_REQUEST["campo"];
    $sentencia .= " AND ";

    switch ($campo) {
        case "NUMPIEZA":
            $sentencia .= "PRE.NUMPIEZA = '" . $_REQUEST["NUMPIEZA"] . "'";
            break;

        case "NUMVEND":
            $sentencia .= "VEN.NUMVEND = '" . $_REQUEST["NUMVEND"] . "'";
            break;

        case "NOMPIEZA":
            $sentencia .= "PIE.NOMPIEZA LIKE '%" . $_REQUEST["NOMPIEZA"] . "%'";
            break;

        case "NOMVEND":
            $sentencia .= "VEN.NOMVEND like '%" . $_REQUEST["NOMVEND"] . "%'";
            break;

        case "PROVINCIA":
            $sentencia .= "VEN.PROVINCIA like '%" . $_REQUEST["PROVINCIA"] . "%'";
            break;

        case "rprecio":
            $menor = $_REQUEST["imenor"];
            $mayor = $_REQUEST["imayor"];
            if ($menor > $mayor) {
                $aux = $menor;
                $menor = $mayor;
                $mayor = $aux;
            }
            $sentencia .= "PIE.PRECIOVENT BETWEEN $menor AND $mayor";
            break;
    }
}

$resultado = $conexion->query($sentencia);


if ($conexion->affected_rows >= 1) {

    echo " <div>
                <table class=' table table-stripped'> ";

    echo "<tr class='thead'>
                <th>Numero de pieza</th>
                <th>Numero de vendedor</th> 
                <th>Nombre de la pieza</th>     
                <th>Nombre del vendedor</th>        
                <th>Provincia del vendedor</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Acciones</th>
              </tr > ";

    while ($fila = $resultado->fetch_assoc()) {
        $NUMVEND = $fila["NUMVEND"];
        $NUMPIEZA = $fila["NUMPIEZA"];
        echo "<tr>
                    <td> $NUMPIEZA</td>
                    <td> $NUMVEND </td>
                    <td> " . $fila["NOMPIEZA"] . " </td>
                    <td> " . $fila["NOMVEND"] . " </td>
                    <td> " . $fila["PROVINCIA"] . " </td>
                    <td> " . $fila["PRECIOVENT"] . " </td>
                    <td> " . $fila["DESCUENTO"] . " </td>
                    <td>";

        echo "<a href='inicio.php?page=b/bpreciosum&NUMPIEZA=" . $fila["NUMPIEZA"] . "&NUMVEND=" . $fila["NUMVEND"] . "&BORRAR=true'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
        echo "<a href='inicio.php?page=u/upreciosum&NUMPIEZA=" . $fila["NUMPIEZA"] . "&NUMVEND=" . $fila["NUMVEND"] . "&update=true'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>";

        echo "</td>
            </tr > ";
    }

    echo "</table >
        </div >";
}


?>