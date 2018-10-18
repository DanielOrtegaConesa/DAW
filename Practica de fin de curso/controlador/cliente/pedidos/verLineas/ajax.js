$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/pedidos/verLineas/listar.php",
        data: {"codPedido": codPedido},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}

function ajaxEliminar(selector, codPedido, numLinea) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/cliente/pedidos/verLineas/acciones.php",
            data: {"accion": "eliminar", "codPedido": codPedido, "numLineaPedido": numLinea},
            success: function (datos) {
                  console.log(datos);
                listar();
            }
        });
    });
}

function ajaxEditar(selector, codPedido, numLinea) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/cliente/pedidos/verLineas/acciones.php",
            data: {"accion": "editar", "codPedido": codPedido, "numLineaPedido": numLinea},
            success: function (datos) {
                callbackEditar(datos);
            }
        });
    });
}
