$(document).ready(function () {
    verEstadisticas();
});
function verEstadisticas() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/inicio/listar.php",
        success: function (datos) {
            callbackEstadisticas(datos);
        }
    });
}