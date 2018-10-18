<?php
if (isset($_REQUEST["codAlbaran"])) {
    ?>
    <script>
        var codAlbaran = <?=$_REQUEST["codAlbaran"];?>
    </script>
    <?php
    ?>
    <h4>Lineas del Albaran <?=$_REQUEST["codAlbaran"]?></h4>
    <div class="section row">
        <div class="ovweflow-x">
            <table class="responsive-table tablesorter">
                <thead>
                <tr>
                    <th class="ocultoimg">Imagen</th>
                    <th>Articulo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>IVA</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tb">
                </tbody>
                <tfoot id="tf">

                </tfoot>
            </table>
        </div>
    </div>


    <script src="controlador/gestion/albaranes/verLineas/paginacion.js"></script>
    <script src="controlador/gestion/albaranes/verLineas/ajax.js"></script>
    <script src="controlador/gestion/albaranes/verLineas/callback.js"></script>
    <?php
} else {
    echo "<h4>Ha ocurrido un error</h4>";
}
