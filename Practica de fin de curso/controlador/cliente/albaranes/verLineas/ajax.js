$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/albaranes/verLineas/listar.php",
        data: {"codAlbaran": codAlbaran},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}

