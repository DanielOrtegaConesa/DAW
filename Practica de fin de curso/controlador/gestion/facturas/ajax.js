$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/facturas/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}

function ajaxEliminar(selector, codFactura) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/facturas/acciones.php",
            data: {"accion": "eliminar", "codFactura": codFactura},
            success: function (datos) {
                listar();
            }
        });
    });
}

function ajaxEditar(selector, codFactura) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/facturas/acciones.php",
            data: {"accion": "editar", "codFactura": codFactura},
            success: function (datos) {
                callbackEditar(datos);
            }
        });
    });
}

function ajaxActualizar(codFactura, descuento) {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/facturas/acciones.php",
        data: {"accion": "actualizar", "codFactura": codFactura, "descuento": descuento},
        success: function (datos) {
            callbackActualizar(datos)
        }
    });
}

$("#imprimir").click(function () {
        let seleccionados = [];
        $('input[type=checkbox]:checked').each(function () {
            seleccionados.push($(this).val());
        });
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/facturas/acciones.php",
            data: {"accion": "imprimir", "seleccionados": JSON.stringify(seleccionados)},
            success: function (datos) {
                showDescarga(datos);
            },
        });
    }
);


$("#tbuscar,#cbuscar").change(function () {
    pag = 0;
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/facturas/listar.php",
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
        url: "controlador/gestion/facturas/listar.php",
        data: {"pag": pag, "tbuscar": tbuscar, "cbuscar": cbuscar},
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
        url: "controlador/gestion/facturas/listar.php",
        data: {"pag": pag, "tbuscar": tbuscar, "cbuscar": cbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});