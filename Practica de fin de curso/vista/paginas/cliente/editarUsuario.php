<?php
include_once "controlador/php/funciones.php";
include_once "modelo/autoload.php";
$res = selectPrepPDO($conexion, "*", "clientes", arrayDatosPDO("codCliente", $_SESSION["usuario"]->getCodCliente()))[0];

if (isset($_REQUEST["enviado"])) {
    include_once "controlador/cliente/editarUsuario/editarUsuario.php";
}

?>
<form method="post" enctype="multipart/form-data">
    <div class='row'>
        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='razonSocial'
                    name='razonSocial'
                    pattern=".{0,50}"
                    data-length="50"
                    value="<?= $res["razonSocial"] ?>"
            />
            <label for='razonSocial' data-error="Debe tener menos de 50 caracteres">Razon Social</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='domicilioSocial'
                    name='domicilioSocial'
                    pattern=".{0,50}"
                    data-length="50"
                    value="<?= $res["domicilioSocial"] ?>"
            />
            <label for='domicilioSocial' data-error="Debe tener menos de 50 caracteres">Domicilio Social</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='ciudad'
                    name='ciudad'
                    pattern=".{0,50}"
                    data-length="50"
                    value="<?= $res["ciudad"] ?>"
            />
            <label for='ciudad' data-error="Debe tener menos de 50 caracteres">Ciudad</label>
        </div>

        <!--Email Validation as per RFC2822 standards -->
        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='email'
                    id='email'
                    name='email'
                    pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"
                    data-length="50"
                    value="<?= $res["email"] ?>"
            />
            <label for='email'
                   data-error="Debe tener menos de 50 caracteres y cumplir con el formato de un email valido">Email</label>
        </div>


        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='tel'
                    id='telefono'
                    name='telefono'
                    pattern="[0-9]{9}"
                    data-length="9"
                    value="<?= $res["telefono"] ?>"
            />
            <label for='telefono' data-error="Debe tener 9 numeros">Telefono</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='password'
                    id='pass'
                    name='pass'
                    pattern=".{0,50}"
                    data-length="50"
            />
            <label for='pass' data-error="Debe tener menos de 50 caracteres">Introduce tu nueva contraseña</label>
        </div>

        <div class='input-field col s12'>
            <div class="file-field input-field">
                <div class="btn blue lighten-1">
                    <span>Imagen</span>
                    <input type="file" name="img">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>

        <div class="row section"></div>

        <div class='row'>
            <button type='submit' id="btn" name="enviado" class='col s12 btn btn-large waves-effect'>Actualizar</button>
        </div>

    </div>
</form>
