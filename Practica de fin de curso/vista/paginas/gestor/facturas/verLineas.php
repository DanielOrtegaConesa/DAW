<?php
if (isset($_REQUEST["codFactura"])) {
    ?>
    <script>
        var codFactura = <?=$_REQUEST["codFactura"];?>
    </script>
    <?php
    ?>
    <h4>Lineas de la factura <?= $_REQUEST["codFactura"] ?></h4>
    <div class="section row">
        <div class="ovweflow-x">
            <table class="responsive-table tablesorter">
                <thead>
                <tr>
                    <th class="ocultoimg">Articulo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Albaran</th>
                </tr>
                </thead>
                <tbody id="tb">
                </tbody>
                <tfoot id="tf">

                </tfoot>
            </table>
        </div>
    </div>

    <div class="section center">
        <div class="input-field ">
            <label for="aeliminar">Eliminar Albaran</label>
            <input id="aeliminar" type="number" class="validate" data-length="50">
        </div>
        <a class="waves-effect waves-light btn deep-purple lighten-1" id="aeliminardisp"><i class="material-icons left">delete</i>Eliminar</a>
    </div>

    <script src="controlador/gestion/facturas/verLineas/paginacion.js"></script>
    <script src="controlador/gestion/facturas/verLineas/ajax.js"></script>
    <script src="controlador/gestion/facturas/verLineas/callback.js"></script>
    <?php
} else {
    echo "<h4>Ha ocurrido un error</h4>";
}
