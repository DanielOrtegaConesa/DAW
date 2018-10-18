<div>
    <h3>Mis Pedidos</h3>
</div>
<div class="container">
    <div class="notice notice-success">
        <strong>Recuerda: </strong> Al hacer click en eliminar eliminarás el pedido completo, es decir, todos los
        articulos que tengan el mismo numero de pedido
    </div>
</div>
<div class="centradohorizontal">
    <form method="post">
        <div class="form-group">
            <label for="campo">Campo donde buscar:</label>
            <select name="campo" id="campo" class="custom-select" onchange="mostrarpedidos(this.value)">
                <option value="NUMPEDIDO">Numero de pedido</option>
                <option value="FECHA">Fecha</option>
                <option value="NUMPIEZA">Numero de pieza</option>
                <option value="NOMPIEZAYCANTIDAD">Nombre de pieza y Cantidad</option>
            </select>
        </div>

        <div id="opcionales">
            <div class="form-group">
                <label>Numero: </label>
                <input type="text" name="NUMPEDIDO" class="form-controls"/>
            </div>
        </div>

        <input type="submit" name="buscar" id="submit" class="btn btn-default" value="Buscar">
    </form>
</div>

<hr/>
<?php
if (isset($_REQUEST["NUMPEDIDO"])) {
    eliminarpedido($conexion, $_REQUEST["NUMPEDIDO"]);
}

$sentencia = "
SELECT * FROM PEDIDO
INNER JOIN LINPED
on PEDIDO.NUMPEDIDO = LINPED.NUMPEDIDO
INNER JOIN PIEZA
on LINPED.NUMPIEZA = PIEZA.NUMPIEZA
WHERE NUMVEND = '" . $_SESSION["usuario"] . "' AND ";

if (isset($_REQUEST["buscar"])) {/* Si se ha introducido un filtro de busqueda */
    $campo = $_REQUEST["campo"];

    switch ($campo) {
        case "NUMPEDIDO":
            $sentencia .= "PEDIDO.NUMPEDIDO = '" . $_REQUEST["NUMPEDIDO"] . "'";
            break;

        case "FECHA":
            $sentencia .= "PEDIDO.FECHA like '%" . $_REQUEST["FECHA"] . "%'";
            break;

        case "NUMPIEZA":
            $sentencia .= "PIEZA.NUMPIEZA = '" . $_REQUEST["NUMPIEZA"] . "'";
            break;

        case "NOMPIEZAYCANTIDAD":
            $sentencia .= "NOMPIEZA like '%" . $_REQUEST["NOMPIEZA"] . "%' AND CANTPEDIDA = " . $_REQUEST["CANTIDAD"];
            break;
    }

//////////////

    $resultado = $conexion->query($sentencia);

    if ($conexion->affected_rows >= 1) {

        echo " <div>
                <table class=' table table-stripped'> ";

        echo "<tr class='thead'>
                <th> Imagen</th>
                <th> Num Pedido</th> 
                <th> Fecha </th> 
                <th> Num Pieza </th>
                <th> Nom Pieza </th>
                <th> Cantidad</th>
                <th> Precio Unitario</th>
                <th> Eliminar </th>
              </tr > ";

        while ($fila = $resultado->fetch_assoc()) {
            echo " <tr>
                    <td> <img src=' " . $fila["RUTAIMG"] . "'></td >
                    <td> " . $fila["NUMPEDIDO"] . " </td>
                    <td> " . $fila["FECHA"] . " </td>
                    <td> " . $fila["NUMPIEZA"] . " </td>
                    <td> " . $fila["NOMPIEZA"] . " </td>
                    <td> " . $fila["CANTPEDIDA"] . " </td>
                    <td> " . $fila["PRECIOVENT"] . " </td>
                    <td> <a href='inicio.php?page=buscadorpedidos&NUMPEDIDO=" . $fila["NUMPEDIDO"] . "'><i class=\"fa fa-3x fa-eraser\" aria-hidden=\"true\"></i></a></td>
                  </tr > ";

        }

        echo "</table >
            </div > ";

    } else {
        echo "Sin resultados";
    }
} else {
    $sentencia .= "1 = 1";

    $resultado = $conexion->query($sentencia);

    if ($conexion->affected_rows >= 1) {

        echo " <div>
                <table class=' table table-stripped'> ";

        echo "<tr class='thead'>
                <th> Imagen</th>
                <th> Num Pedido</th> 
                <th> Fecha </th> 
                <th> Num Pieza </th>
                <th> Nom Pieza </th>
                <th> Cantidad</th>
                <th> Precio Unitario</th>
                <th> Eliminar</th>
              </tr > ";

        while ($fila = $resultado->fetch_assoc()) {
            echo " <tr>
                    <td> <img src=' " . $fila["RUTAIMG"] . "'></td >
                    <td> " . $fila["NUMPEDIDO"] . " </td>
                    <td> " . $fila["FECHA"] . " </td>
                    <td> " . $fila["NUMPIEZA"] . " </td>
                    <td> " . $fila["NOMPIEZA"] . " </td>
                    <td> " . $fila["CANTPEDIDA"] . " </td>
                    <td> " . $fila["PRECIOVENT"] . " </td>
                    <td> <a href='inicio.php?page=buscadorpedidos&NUMPEDIDO=" . $fila["NUMPEDIDO"] . "'><i class=\"fa fa-3x fa-eraser\" aria-hidden=\"true\"></i></a></td>
                  </tr > ";

        }

        echo "</table >
            </div > ";
    }
}


?>