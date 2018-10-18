<div>
    <h3>Articulos</h3>
</div>
<div class="centradohorizontal">
    <form method="post">
        <div class="form-group">
            <label for="campo">Campo donde buscar:</label>
            <select name="campo" id="campo" class="custom-select" onchange="mostrar(this.value)">
                <option value="NOMPIEZA">Nombre</option>
                <option value="NUMPIEZA">Numero</option>
                <option value="PRECIOVENT">Precio</option>
            </select>
        </div>

        <div class="form-group" id="divmodo">
            <label for="modo">Modo en el que buscar</label>
            <select name="modo" id="modo" class="custom-select">
                <option>Exacto</option>
                <option>Empieza</option>
                <option>Acaba</option>
                <option>Contiene</option>
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

if (isset($_REQUEST["NUMPIEZA"])) {/*Si se ha pulsado el boton añadir al carrito*/
    $NUMPIEZA = $_REQUEST["NUMPIEZA"];
    $pieza = new Pieza($NUMPIEZA);
    $_SESSION["carrito"]->addPieza($pieza);
}


if (isset($_REQUEST["buscar"])) {/* Si se ha introducido un filtro de busqueda */
    $campo = $_REQUEST["campo"];
    $modo = $_REQUEST["modo"];

    $texto = "";
    if (isset($_REQUEST["inombre"])) {
        $texto = $_REQUEST["inombre"];

    } else if (isset($_REQUEST["inumero"])) {
        $texto = $_REQUEST["inumero"];

    } else if (isset($_REQUEST["imenor"])) {
        $menor = $_REQUEST["imenor"];
        $mayor = $_REQUEST["imayor"];
        if ($menor > $mayor) {
            $aux = $menor;
            $menor = $mayor;
            $mayor = $aux;
        }
        $texto = "BETWEEN $menor AND $mayor";
    }


    $conexion = conectar();
    $sentencia = "select * from pieza where 1 = 1 ";

    if ($campo != "PRECIOVENT") {
        switch ($modo) {
            case "Exacto":
                $sentencia .= "and $campo like '" . $texto . "'";
                break;
            case "Empieza":
                $sentencia .= "and $campo like '" . $texto . "%'";
                break;

            case "Acaba":
                $sentencia .= "and $campo like '%" . $texto . "'";
                break;

            case "Contiene":
                $sentencia .= "and $campo like '%" . $texto . "%'";
                break;
        }
    } else {
        $sentencia .= "and $campo $texto";
    }

} else {/* Si no se ha puesto filtro de busqueda*/
    $sentencia = "select * from pieza";
}

/* Se ejecuta siempre */
$resultado = $conexion->query($sentencia);

if ($conexion->affected_rows >= 1) {

    echo " <div>
                <table class=' table table-stripped'> ";

    echo "<tr class='thead'>
                <th> Imagen</th>
                <th> Numero </th> 
                <th> Nombre </th> 
                <th> Precio </th>
                <th> Añadir al carrito </th>
              </tr > ";

    while ($fila = $resultado->fetch_assoc()) {
        echo " <tr>
                    <td> <img src=' " . $fila["RUTAIMG"] . "'></td >
                    <td> " . $fila["NUMPIEZA"] . " </td >
                    <td> " . $fila["NOMPIEZA"] . " </td >
                    <td> " . $fila["PRECIOVENT"] . " </td >
                    <td><a href='inicio.php?page=buscador&NUMPIEZA=" . $fila["NUMPIEZA"] . "'><i class=\"fa fa-3x fa-cart-plus\" aria-hidden=\"true\"></i></a></td>
                  </tr > ";

    }

    echo "</table >
            </div > ";

} else {
    echo "Sin resultados";
}

?>