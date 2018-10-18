<?php
if (isset($_SESSION["cliente"])) {
    $cliente = $_SESSION["cliente"];
    ?>
    <h4>Articulos</h4>
    <p><?= $cliente ?></p>
    <div class="section row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">search</i>
            <input id="tbuscar" type="text" class="validate" data-length="50">
        </div>
        <div class="input-field col s12 m6 ">
            <select id="cbuscar">
                <option value="nombre">Nombre</option>
                <option value="precioI">Precio Inferior</option>
                <option value="precioS">Precio Superior</option>
            </select>
        </div>
    </div>

    <div class="section row">
        <div id="contenedorArticulos"></div>
    </div>


    <div class="row pagination center">
        <btn class="waves-effect" id="menos"><a href="#"><i class="material-icons">chevron_left</i></a></btn>
        <span class="waves-effect" id="muestrapag">1</span>
        <btn class="waves-effect" id="mas"><a href="#"><i class="material-icons">chevron_right</i></a></btn>
    </div>

    <script src="controlador/gestion/articulos/paginacion.js"></script>
    <script src="controlador/gestion/articulos/ajax.js"></script>
    <script src="controlador/gestion/articulos/callback.js"></script>
    <?php
} else {
    ?>
    <h4>Primero tienes que seleccionar a un cliente</h4>
    <p>Para ello ve al apartado cliientes y utiliza la accion seleccionar <a
                class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1'><i class='material-icons'>pan_tool</i></a>
    </p>
    <?php
}