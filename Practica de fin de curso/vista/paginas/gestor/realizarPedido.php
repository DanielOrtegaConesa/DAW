<?php
if (isset($_SESSION["cliente"])) {
    $cliente = $_SESSION["cliente"];
    ?>
    <h4>Realizar Pedido</h4>
    <p><?= $cliente ?></p>


    <div class="section row">
        <div class="ovweflow-x">
            <table class="responsive-table tablesorter">
                <thead>
                <tr>
                    <th class="ocultoimg"></th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="tb">
                <tr>
                    <td colspan="6">Selecciona primero articulos desde el menu de busqueda de articulos</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="section center">
        <a class="waves-effect waves-light btn light-green" id="rpedido"><i class="material-icons left">attach_money</i>Pedir</a>
    </div>

    <script src="controlador/gestion/realizarPedido/ajax.js"></script>
    <script src="controlador/gestion/realizarPedido/callback.js"></script>


    <?php
} else {
    ?>
    <h4>Primero tienes que seleccionar a un cliente</h4>
    <p>Para ello ve al apartado cliientes y utiliza la accion seleccionar <a
                class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1'><i class='material-icons'>pan_tool</i></a>
    </p>
    <?php
}