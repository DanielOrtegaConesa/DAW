<h4>Albaranes </h4>
<div class="section row">
    <div class="input-field col s12 m6">
        <i class="material-icons prefix">search</i>
        <input id="tbuscar" type="text" class="validate" data-length="50">
    </div>
    <div class="input-field col s12 m6 ">
        <select id="cbuscar">
            <option value="nick">Para</option>
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
                <th>Facturar</th>
                <th>Para</th>
                <th>Pedido</th>
                <th>Albaran</th>
                <th>C. Articulos</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tb">
            </tbody>
        </table>
    </div>
</div>

<div class="section center">
    <div class="input-field ">
        <label for="descuento">Descuento Global</label>
        <input id="descuento" type="number" class="validate" data-length="50">
    </div>
    <a class="waves-effect waves-light btn deep-purple lighten-1" id="facturar"><i class="material-icons left">attach_money</i>Facturar Selecccionados</a>
</div>

<div class="row pagination center">
    <btn class="waves-effect" id="menos"><a href="#"><i class="material-icons">chevron_left</i></a></btn>
    <span class="waves-effect" id="muestrapag">1</span>
    <btn class="waves-effect" id="mas"><a href="#"><i class="material-icons">chevron_right</i></a></btn>
</div>
<script src="controlador/gestion/albaranes/paginacion.js"></script>
<script src="controlador/gestion/albaranes/ajax.js"></script>
<script src="controlador/gestion/albaranes/callback.js"></script>
