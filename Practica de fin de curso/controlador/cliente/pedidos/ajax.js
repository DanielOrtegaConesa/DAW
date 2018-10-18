$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/pedidos/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}

function ajaxEliminar(selector, codPedido) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/cliente/pedidos/acciones.php",
            data: {"accion": "eliminar", "codPedido": codPedido},
            success: function (datos) {
                console.log(datos);
                listar();
            }
        });
    });
}

$("#tbuscar,#cbuscar").change(function () {
    pag = 0;
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/pedidos/listar.php",
        data: {"pag": pag, "tbuscar": tbuscar, "cbuscar": cbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
})

$("#menos").click(function () {
    pmenos();
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/pedidos/listar.php",
        data: {"pag": pag , "cbuscar": cbuscar, "tbuscar": tbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});

$("#mas").click(function () {
    pmas();
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/pedidos/listar.php",
        data: {"pag": pag , "cbuscar": cbuscar, "tbuscar": tbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});