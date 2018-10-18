$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/albaranes/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}


function ajaxEliminar(selector, codAlbaran) {
    $(selector).click(function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/albaranes/acciones.php",
            data: {"accion": "eliminar", "codAlbaran": codAlbaran},
            success: function (datos) {
               // console.log(datos);
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
        url: "controlador/gestion/albaranes/listar.php",
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
        url: "controlador/gestion/albaranes/listar.php",
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
        url: "controlador/gestion/albaranes/listar.php",
        data: {"pag": pag , "cbuscar": cbuscar, "tbuscar": tbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});


$("#facturar").click(function () {
    let seleccionados = [];
    $('input[type=checkbox]:checked').each(function () {
        ////console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
        seleccionados.push($(this).val());
    });
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/albaranes/acciones.php",
        data: {"accion": "facturar","descuento":$("#descuento").val(), "seleccionados": JSON.stringify(seleccionados)},
        success: function (datos) {
            callbackFacturar(datos);
        },
    });
});