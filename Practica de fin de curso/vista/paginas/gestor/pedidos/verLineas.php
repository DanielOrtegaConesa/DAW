<?php
if (isset($_REQUEST["codPedido"])) {
    ?>
    <script>
        var codPedido = <?=$_REQUEST["codPedido"];?>
    </script>
    <?php
    ?>
    <h4>Lineas del Pedido <?=$_REQUEST["codPedido"]?></h4>
    <div class="section row">
        <div class="ovweflow-x">
            <table class="responsive-table tablesorter">
                <thead>
                <tr>
                    <th>Procesar</th>
                    <th class="ocultoimg">Imagen</th>
                    <th>Articulo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
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


    <div class="section center">
        <a class="waves-effect waves-light btn deep-purple lighten-1" id="procesar"><i class="material-icons left">attach_money</i>Procesar Seleccionados</a>
    </div>

    <script src="controlador/gestion/pedidos/verLineas/paginacion.js"></script>
    <script src="controlador/gestion/pedidos/verLineas/ajax.js"></script>
    <script src="controlador/gestion/pedidos/verLineas/callback.js"></script>
    <?php
} else {
    echo "<h4>Ha ocurrido un error</h4>";
}
