$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/albaranes/verLineas/listar.php",
        data: {"codAlbaran": codAlbaran},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}

function ajaxEliminar(selector, codAlbaran, numLinea) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/albaranes/verLineas/acciones.php",
            data: {"accion": "eliminar", "codAlbaran": codAlbaran, "numLineaAlbaran": numLinea},
            success: function (datos) {
               // console.log(datos);
                listar();
            }
        });
    });
}

function ajaxEditar(selector, codAlbaran, numLinea) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/albaranes/verLineas/acciones.php",
            data: {"accion": "editar", "codAlbaran": codAlbaran, "numLineaAlbaran": numLinea},
            success: function (datos) {
                callbackEditar(datos);
            }
        });
    });
}


