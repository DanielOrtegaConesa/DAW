<?php
include "../includes/funciones.php";
include "../includes/funciones_BBDD.php";
$errores = false;

if (isset($_POST["usu"])) {
    //recogemos datos
    $usu = $_POST["usu"];
    $pass = $_POST["pass"];

    if ($usu == "") {
        $errores[] = "El usuario es nulo";
    }

    if ($pass == "") {
        $errores[] = "La contraseña es nula";
    }

    if ($errores == false) {
        $encriptada = encriptar($pass);

        $conexion = conectar();
        $sentencia = "SELECT * FROM USUARIOS WHERE nombre = (?) AND pass = (?)";
        $consulta_prep = $conexion->prepare($sentencia);
        $consulta_prep->bind_param('ss', $usu, $pass);

        $resultado = $consulta_prep->execute();
        $resultado = $consulta_prep->get_result();

        if ($resultado->num_rows != 1) {
            $errores[] = "El usuario o la contraseña no es correcto";
            header("location:login.php?errores=" . array_a_cadenaurl($errores) . "&usuario=" . urlencode($usu));
        }

    } else {
        header("location:login.php?errores=" . array_a_cadenaurl($errores) . "&usuario=" . urlencode($usu));
    }

    if ($errores == false) {
        session_start();
        $_SESSION["usuario"] = $usu;
        header("location:../inicio.php");
    }

} else {
    header("location:login.php?"); //redirecciona
}

?>