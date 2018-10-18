<?php
$cliente = $_SESSION["usuario"];
?>
    <h4>Articulos</h4>
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

    <script src="controlador/cliente/articulos/paginacion.js"></script>
    <script src="controlador/cliente/articulos/ajax.js"></script>
    <script src="controlador/cliente/articulos/callback.js"></script>