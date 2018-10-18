<link rel=StyleSheet href="vista/estilo/css/deslogeado.css" type="text/css" MEDIA=all>

<div class="section"></div>
<form class="z-depth-1 grey lighten-4 s12" id="datos" name="datos">

    <div class='row'>
        <div class='input-field col s12 m6'>
            <input
                    class='validate'
                    type='text'
                    id='dni'
                    name='dni'
                    pattern="\d{8}[A-z]{1}"
                    data-length="9"
                    required
            />
            <label for='dni' data-error="Un dni valido tiene 8 numeros seguidos de una letra">DNI</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='razonSocial'
                    name='razonSocial'
                    pattern=".{1,50}"
                    data-length="50"
                    required
            />
            <label for='razonSocial' data-error="Debe tener menos de 50 caracteres">Razon Social</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='domicilioSocial'
                    name='domicilioSocial'
                    pattern=".{1,50}"
                    data-length="50"
                    required
            />
            <label for='domicilioSocial' data-error="Debe tener menos de 50 caracteres">Domicilio Social</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='ciudad'
                    name='ciudad'
                    pattern=".{1,50}"
                    data-length="50"
                    required
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
                    required
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
                    required
            />
            <label for='telefono' data-error="Debe tener 9 numeros">Telefono</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='text'
                    id='nick'
                    name='nick'
                    pattern=".{1,50}"
                    data-length="50"
                    required
            />
            <label for='nick' data-error="Debe tener menos de 50 caracteres">Nick</label>
        </div>

        <div class='input-field col s12  m6'>
            <input
                    class='validate'
                    type='password'
                    id='pass'
                    name='pass'
                    pattern=".{1,50}"
                    data-length="50"
                    required
            />
            <label for='pass' data-error="Debe tener menos de 50 caracteres">Introduce tu contraseña</label>
        </div>

        <div class="row section"></div>

        <div class="row ovweflow-x">
            <div class="g-recaptcha" data-sitekey="6LdFuEgUAAAAAJDO5ZL28eNRdEbydYvmIYYuDUdR"></div>
        </div>
        <br/>
        <div class='row centered'>
            <button type='submit' id="btn" class='col s12 btn btn-large waves-effect'>Solicitar</button>
        </div>

        <a class='pink-text' href='index.php?page=login'>¿ Ya estas registrado ?</a>
    </div>
</form>


<script src="controlador/registro/ajax.js"></script>
<script src="controlador/registro/callback.js"></script>

