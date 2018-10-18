function callbackListar(datos) {
    $("#tb").empty();
    datos = JSON.parse(datos);

    max = datos.fin;
    let resultados = datos.resultados;
    for (let c in datos.resultados) {
        $("#tb").append(
            "<tr>" +
            "<td>" + resultados[c]["nick"] + "</td>" +
            "<td>" + resultados[c]["email"] + "</td>" +
            "<td>" + resultados[c]["telefono"] + "</td>" +
            "<td>" + resultados[c]["dni"] + "</td>" +
            "<td>" + resultados[c]["razonSocial"] + "</td>" +
            "<td>" + resultados[c]["domicilioSocial"] + "</td>" +
            "<td>" +
            "<a class=\"btn-floating btn-large waves-effect waves-light deep-purple lighten-1\" id='" + resultados[c]["nick"] + "Aceptar'><i class=\"material-icons left\">check</i></a>" +
            "<a class=\"btn-floating btn-large waves-effect waves-light red lighten-1\" id='" + resultados[c]["nick"] + "Rechazar'><i class=\"material-icons left\">delete</i></a>" +
            "</td>" +
            "</tr>"
        );

        $("#" + resultados[c]["nick"] + "Aceptar").click(function () {
            $.ajax({
                method: "GET",
                cache: false,
                url: "controlador/gestion/administrarUsuarios/acciones.php",
                data: {"nick": resultados[c]["nick"], "accion": "aceptar"},
                success: function (datos) {
                    listar(datos);
                }
            })
        });

        $("#" + resultados[c]["nick"] + "Rechazar").click(function () {
            $.ajax({
                method: "GET",
                cache: false,
                url: "controlador/gestion/administrarUsuarios/acciones.php",
                data: {"nick": resultados[c]["nick"], "accion": "rechazar"},
                success: function (datos) {
                    listar(datos);
                }
            })
        });
    }
    muestrapag();
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

