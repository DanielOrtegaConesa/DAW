$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/pedidos/verLineas/listar.php",
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
            url: "controlador/gestion/pedidos/verLineas/acciones.php",
            data: {"accion": "eliminar", "codPedido": codPedido, "numLineaPedido": numLinea},
            success: function (datos) {
                //   console.log(datos);
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
            url: "controlador/gestion/pedidos/verLineas/acciones.php",
            data: {"accion": "editar", "codPedido": codPedido, "numLineaPedido": numLinea},
            success: function (datos) {
                callbackEditar(datos);
            }
        });
    });
}


$("#procesar").click(function () {
    let seleccionados = [];
    $('input[type=checkbox]:checked').each(function () {
        ////console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
        seleccionados.push($(this).val());
    });
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/pedidos/verLineas/acciones.php",
        data: {"accion": "procesar", "seleccionados": JSON.stringify(seleccionados)},
        success: function (datos) {
            callbackProcesar(datos);
        }
    });
});

