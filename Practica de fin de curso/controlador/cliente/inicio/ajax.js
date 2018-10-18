$(document).ready(function () {
    verEstadisticas();
});
function verEstadisticas() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/cliente/inicio/listar.php",
        success: function (datos) {
            callbackEstadisticas(datos);
        }
    });
}