$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/facturas/verLineas/listar.php",
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
        url: "controlador/cliente/facturas/verLineas/acciones.php",
        data: {"accion": "procesar", "seleccionados": JSON.stringify(seleccionados)},
        success: function (datos) {
            callbackProcesar(datos);
        }
    });
});

