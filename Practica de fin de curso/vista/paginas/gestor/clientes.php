<h4>Clientes </h4>
<div class="section row">
    <div class="input-field col s12 m6">
        <i class="material-icons prefix">search</i>
        <input id="tbuscar" type="text" class="validate" data-length="50">
    </div>
    <div class="input-field col s12 m6 ">
        <select id="cbuscar">
            <option value="nick">Nick</option>
            <option value="email">Email</option>
            <option value="telefono">Telefono</option>
            <option value="dni">DNI</option>
            <option value="razonSocial">Razon Social</option>
        </select>
    </div>
</div>
<a class="waves-effect waves-light btn deep-purple lighten-1" id="addperson" ><i class="material-icons">person add</i></a>
<div class="section row">
    <div class="ovweflow-x">
        <table class="responsive-table highlight tablesorter">
            <thead>
            <tr>
                <th class="ocultoimg">Imagen</th>
                <th>Nick</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>DNI</th>
                <th>Razon Social</th>
                <th>Acciones</th>
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
<script src="controlador/gestion/clientes/paginacion.js"></script>
<script src="controlador/gestion/clientes/ajax.js"></script>
<script src="controlador/gestion/clientes/callback.js"></script>
