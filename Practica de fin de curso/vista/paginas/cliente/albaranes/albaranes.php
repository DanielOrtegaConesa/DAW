<h4>Albaranes </h4>
<div class="section row">
    <div class="input-field col s12 m6">
        <i class="material-icons prefix">search</i>
        <input id="tbuscar" type="text" class="validate" data-length="50">
    </div>
    <div class="input-field col s12 m6 ">
        <select id="cbuscar">
            <option value="codAlbaran">Albaran</option>
            <option value="fecha">Fecha</option>
        </select>
    </div>
</div>
<div class="section row">
    <div class="ovweflow-x">
        <table class="responsive-table highlight tablesorter">
            <thead>
            <tr>
                <th>Pedido</th>
                <th>Albaran</th>
                <th>C. Articulos</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody id="tb">
            </tbody>
        </table>
    </div>
</div>

<div class="row pagination center">
    <btn class="waves-effect" id="menos"><a href="#"><i class="material-icons">chevron_left</i></a></btn>
    <span class="waves-effect" id="muestrapag">1</span>
    <btn class="waves-effect" id="mas"><a href="#"><i class="material-icons">chevron_right</i></a></btn>
</div>
<script src="controlador/cliente/albaranes/paginacion.js"></script>
<script src="controlador/cliente/albaranes/ajax.js"></script>
<script src="controlador/cliente/albaranes/callback.js"></script>
