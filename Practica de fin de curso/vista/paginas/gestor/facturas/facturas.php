<h4>Facturas </h4>
<div class="section row">
    <div class="input-field col s12 m6">
        <i class="material-icons prefix">search</i>
        <input id="tbuscar" type="text" class="validate" data-length="50">
    </div>
    <div class="input-field col s12 m6 ">
        <select id="cbuscar">
            <option value="nick">Para</option>
            <option value="codFactura">Factura</option>
            <option value="fecha">Fecha</option>
        </select>
    </div>
</div>
<div class="section row">
    <div class="ovweflow-x">
        <table class="responsive-table highlight tablesorter">
            <thead>
            <tr>
                <th>Imprimir</th>
                <th>Factura</th>
                <th>Para</th>
                <th>Fecha</th>
                <th>Descuento</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tb">
            </tbody>
        </table>
    </div>
</div>

<div class="section center">
    <a class="waves-effect waves-light btn deep-purple lighten-1" id="imprimir"><i class="material-icons left">print</i>Imprimir Seleccioandos</a>
</div>

<div class="row pagination center">
    <btn class="waves-effect" id="menos"><a href="#"><i class="material-icons">chevron_left</i></a></btn>
    <span class="waves-effect" id="muestrapag">1</span>
    <btn class="waves-effect" id="mas"><a href="#"><i class="material-icons">chevron_right</i></a></btn>
</div>

<script src="controlador/gestion/facturas/paginacion.js"></script>
<script src="controlador/gestion/facturas/ajax.js"></script>
<script src="controlador/gestion/facturas/callback.js"></script>

<script src="controlador/gestion/facturas/facturas.js"></script>
<script src="vista/librerias/jspdf/jspdf.min.js"></script>
<script src="vista/librerias/jspdf/jspdf.addimage.min.js"></script>
<script src="vista/librerias/jspdf/jspdf.autotable.min.js"></script>

