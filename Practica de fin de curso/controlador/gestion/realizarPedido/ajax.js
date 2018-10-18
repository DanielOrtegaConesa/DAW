$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/realizarPedido/acciones.php",
        data:{"accion":"verCarrito"},
        success: function (datos) {
            callbackVerCarrito(datos);
        }
    });
}

$("#tbuscar,#cbuscar").change(function () {
    pag = 0;
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/clientes/listar.php",
        data: {"pag": pag, "tbuscar": tbuscar,"cbuscar":cbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
})

function ajaxEliminar(selector,codArticulo) {
    $(selector).click(function (){
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/realizarPedido/acciones.php",
            data:{"accion":"eliminarArticulo","codArticulo":codArticulo},
            success: function (datos) {
                listar(datos);
            }
        });
    });
}

function ajaxCambiarCantidad(selector,codArticulo) {
$(selector).blur(function () {
    let cantidad = $(selector).val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/realizarPedido/acciones.php",
        data:{"accion":"cambiarCantidad","cantidad":cantidad,"codArticulo":codArticulo},
        success: function (datos) {
            callbackCambiarCantidad(datos);
        }
    });
})
}

$("#rpedido").click(function () {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/realizarPedido/acciones.php",
        data:{"accion":"tramitarPedido"},
        success: function (datos) {
          callbackTramitarPedido(datos);
        }
    });
})