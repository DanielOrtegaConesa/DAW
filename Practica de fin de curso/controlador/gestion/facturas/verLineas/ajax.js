$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/facturas/verLineas/listar.php",
        data: {"codFactura": codFactura},
        success: function (datos) {
            callbackListar(datos);
        }
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
        url: "controlador/gestion/facturas/verLineas/acciones.php",
        data: {"accion": "procesar", "seleccionados": JSON.stringify(seleccionados)},
        success: function (datos) {
            callbackProcesar(datos);
        }
    });
});

$("#aeliminardisp").click(function () {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/facturas/verLineas/acciones.php",
        data: {"accion": "eliminarAlbaran", "codAlbaran": $("#aeliminar").val(), "codFactura": codFactura},
        success: function (datos) {
            console.log(datos);
            listar();
            //callbackProcesar(datos);
        }
    });
});
