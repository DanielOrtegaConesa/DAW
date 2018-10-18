<link rel=StyleSheet href="vista/estilo/css/deslogeado.css" type="text/css" MEDIA=all>

<div class="section"></div>
<div class="z-depth-1 grey lighten-4 col s6" id="principal">
    <form method="post" id="datos">
        <div class='row'>
            <div class='input-field col s12'>
                <input
                        class='validate'
                        type='text'
                        id='nick'
                        name="nick"
                        required
                />
                <label for='email'>Introduce tu usuario</label>
            </div>
        </div>

        <div class='row'>
            <div class='input-field col s12'>
                <input
                        class='validate'
                        type='password'
                        id='pass'
                        name="pass"
                        required
                />
                <label for='pass'>Introduce tu contraseña</label>
            </div>
        </div>

        <div class='row'>
            <div class="input-field col s12">
                <select name="tipo" id="tipo">
                    <option value="cliente">Cliente</option>
                    <option value="gestor">Gestor</option>
                </select>
                <label>Tipo de usuario</label>
            </div>
        </div>

        <div class='row'>
            <div class="center-align">
                <div class="row ovweflow-x">
                    <div class="g-recaptcha" data-sitekey="6LdFuEgUAAAAAJDO5ZL28eNRdEbydYvmIYYuDUdR"></div>
                </div>
                <br/>
                <div class="row">
                    <button type='submit' id="btn" name='btn_login' class='col s12 btn btn-large waves-effect'>
                        Entrar
                    </button>
                </div>
            </div>
        </div>
        <a class='pink-text' href='index.php?page=registro'>¿ Todavia no estas registrado ?</a>
        <div class="section"></div>
    </form>
</div>

<script src="controlador/login/ajax.js"></script>
<script src="controlador/login/callback.js"></script>

