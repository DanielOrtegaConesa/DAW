<?php
if (isset($_REQUEST["codFactura"])) {
    ?>
    <script>
        var codFactura = <?=$_REQUEST["codFactura"];?>
    </script>
    <?php
    ?>
    <h4>Lineas de la factura <?=$_REQUEST["codFactura"]?></h4>
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


    <script src="controlador/cliente/facturas/verLineas/paginacion.js"></script>
    <script src="controlador/cliente/facturas/verLineas/ajax.js"></script>
    <script src="controlador/cliente/facturas/verLineas/callback.js"></script>
    <?php
} else {
    echo "<h4>Ha ocurrido un error</h4>";
}
