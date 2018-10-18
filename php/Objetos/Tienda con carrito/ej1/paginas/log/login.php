<?php
include "../includes/funciones.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Jugadores</title>
    <meta name="description" content="Mi pagina">
    <meta name="author" content="Dani">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Auto Prefixer -->
    <script src="../../herramientasweb/js/prefixfree.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../herramientasweb/css/bootstrap.min.css">
    <!-- Mi css -->
    <link rel="stylesheet" href="login.css">

</head>
<body class="d-flex justify-content-center">

<div class="container align-self-center">
    <div class="row justify-content-center">
        <div class="col-md-offset-5 col-md-3">
            <form action="comprobar.php" class="form-login" method="post">
                <h4>Hola de nuevo</h4>
                <input type="text" name="usu" id="usu" class="form-control input-sm chat-input" placeholder="Usuario"/>
                <br/>
                <input type="password" name="pass" id="pass" class="form-control input-sm chat-input"
                       placeholder="Contraseña"/>
                <br/>
                <div class="wrapper">
            <span class="group-btn">
                <input type="submit" class="btn btn-primary btn-md" value="Entrar">
            </span>

            </form>

            <?php
            if (isset($_GET["errores"])) {
                echo "<div>";
                $array = cadenaurl_a_array($_GET["errores"]);
                echo "<br/>";
                foreach ($array as $value) {
                    echo $value . "<br/>";
                }
                echo "</div>";
            }


            ?>
        </div>
    </div>
</div>
</div>


<script src="../../herramientasweb/js/jquery-3.2.1.slim.min.js"></script>
<script src="../../herramientasweb/js/popper.min.js"></script>
<script src="../../herramientasweb/js/bootstrap.min.js"></script>
</body>
</html>
