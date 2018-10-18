<h4>Administracion de Usuarios</h4>
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
            <option value="domicilioSocial">Domicilio Social</option>
        </select>
    </div>
</div>

<div class="section row">
    <table class="centered responsive-table tablesorter">
        <thead>
        <tr>
            <th>Nick</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>DNI</th>
            <th>Razon Social</th>
            <th>Domicilio Social</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tb">
        </tbody>
    </table>
</div>

<div class="row pagination center">
    <btn class="waves-effect" id="menos"><a href="#"><i class="material-icons">chevron_left</i></a></btn>
    <span class="waves-effect" id="muestrapag">1</span>
    <btn class="waves-effect" id="mas"><a href="#"><i class="material-icons">chevron_right</i></a></btn>
</div>

<script src="controlador/gestion/administrarUsuarios/paginacion.js"></script>
<script src="controlador/gestion/administrarUsuarios/ajax.js"></script>
<script src="controlador/gestion/administrarUsuarios/callback.js"></script>

