<?php

$cod = $res["codCliente"];
$razonSocial = $_REQUEST["razonSocial"];
$domicilioSocial = $_REQUEST["domicilioSocial"];
$ciudad = $_REQUEST["ciudad"];
$email = $_REQUEST["email"];
$telefono = $_REQUEST["telefono"];
$pass = $_REQUEST["pass"];
$ad = arrayDatosPDO("codCliente", $cod);
$retornar ["correcto"] = true;

if (existeregistroPrepPDO($conexion, "clientes", $ad)) {


    if (esinf($razonSocial, 50)) {
        $adatos = arrayDatosPDO("razonSocial", $razonSocial);
        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
    }
    if (esinf($domicilioSocial, 50)) {
        $adatos = arrayDatosPDO("domicilioSocial", $domicilioSocial);
        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
    }

    if (esinf($ciudad, 50)) {
        $adatos = arrayDatosPDO("ciudad", $ciudad);
        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
    }

    if (esinf($email, 50)) {
        $adatos = arrayDatosPDO("email", $email);
        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
    }

    if (esinf($telefono, 9)) {
        if (strlen($telefono) == 9) {
            if (esnumero($telefono)) {
                $adatos = arrayDatosPDO("telefono", $telefono);
                updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
            }
        }
    }

    if (esinf($pass, 50)) {
        $adatos = arrayDatosPDO("pass", $pass);
        updatePrepPDO($conexion, "clientes", "codCliente='$cod'", $adatos);
    }

}
$res = selectPrepPDO($conexion, "*", "clientes", arrayDatosPDO("codCliente", $_SESSION["usuario"]->getCodCliente()))[0];

if (isset($_FILES["img"]) && $_FILES["img"]["name"] != "") {
    if ($_FILES["img"]["error"] == 0) {
        require "controlador/php/vendor/autoload.php";

        $storage = new Upload\Storage\FileSystem('vista/img/usuarios'); //Lugar a donde se moverán los archivos

        $file = new \Upload\File('img', $storage); //proporcionas el nombre del campo

        $file->addValidations(array(
            new \Upload\Validation\Extension(array('jpg', 'png', 'gif', 'jpeg')), //validas que sea una extensión valida
            new \Upload\Validation\Mimetype(array('image/jpeg', 'image/png', 'image/gif')), //validas el tipo de imagen
            // new \Upload\Validation\Size('1M'), //validas que no exceda el tamaño
        ));

        //todos los datos sobre el fichero subido estan en este array
        $data = array(
            'name' => $file->getNameWithExtension(),
            'extension' => $file->getExtension(),
            'mime' => $file->getMimetype(),
            'size' => $file->getSize(),
            'md5' => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        );

        //nombre como se guardara, de no poner esto se guardara con el nombre recibido
        $file->setName($res["codCliente"]);

        try {
            $file->upload(); // mover el archivo
            updatePrepPDO($conexion, "clientes", "codCliente=" . $res["codCliente"], arrayDatosPDO("img", "vista/img/usuarios/" . $res["codCliente"] . "." . $data["extension"]));
        } catch (Exception $e) {
            $errors = $file->getErrors();
            $errores = "";
            foreach ($errors as $i => $error) {
                $errores .= "$error<br/>";
            }
        }
    } else {
        $errores = "El tamaño supera el maximo permitido";
    }
}

$_SESSION["usuario"]->cargar($conexion);

if (!isset($errores)) {
    header("location:index.php?page=editarUsuario");
} else {
    echo "<div class='section'>" . $errores . "</div>";
}