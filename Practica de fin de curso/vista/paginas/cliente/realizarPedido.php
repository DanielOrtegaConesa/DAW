<?php
    $cliente = $_SESSION["usuario"];
    ?>
    <h4>Realizar Pedido</h4>

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

                </tbody>
            </table>
        </div>
    </div>
    <div class="section center">
        <a class="waves-effect waves-light btn light-green" id="rpedido"><i class="material-icons left">attach_money</i>Pedir</a>
    </div>

    <script src="controlador/cliente/realizarPedido/ajax.js"></script>
    <script src="controlador/cliente/realizarPedido/callback.js"></script>