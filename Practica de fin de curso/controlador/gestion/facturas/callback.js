function callbackListar(datos) {
    $("#tb").empty();
    datos = JSON.parse(datos);
    max = datos.fin;

    let resultados = datos.resultados;
    for (let c in datos.resultados) {

        let borrar = "<td>   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codFactura"] + "Ver'><i class='material-icons'>open_in_new</i></a> </td>";
        if (resultados[c]["borrable"]) {
            borrar =
                "<td>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codFactura"] + "Ver'><i class='material-icons'>open_in_new</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codFactura"] + "Borrar'><i class='material-icons'>delete</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codFactura"] + "Editar'><i class='material-icons'>mode_edit</i></a>" +
                "<td/>";
        }

        let swit = "<td><div class='switch'>" +
            "    <label>" +
            "      No" +
            "      <input type='checkbox' name='aimprimir' value='" + resultados[c]["codFactura"] + "'>" +
            "      <span class='lever'></span>" +
            "      Si" +
            "    </label>" +
            "</div>" +
            "</td>";

        $("#tb").append(
            "<tr>" +
            swit +
            "<td> " + resultados[c]["codFactura"] + "</td>" +
            "<td> " + resultados[c]["nick"] + "</td>" +
            "<td>" + resultados[c]["fecha"] + "</td>" +
            "<td>" + resultados[c]["descuentoFactura"] + "%</td>" +
            borrar +
            "</tr>"
        );

        ajaxEliminar("#" + resultados[c]["codFactura"] + "Borrar", resultados[c]["codFactura"]);
        ajaxEditar("#" + resultados[c]["codFactura"] + "Editar", resultados[c]["codFactura"]);
        $("#" + resultados[c]["codFactura"] + "Ver").click(function () {
            var redirectWindow = window.open('index.php?page=verLineasFacturas&codFactura=' + resultados[c]["codFactura"] + '', '_blank');
            redirectWindow.location;
        });
        muestrapag();

    }
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackEditar(datos) {
    datos = JSON.parse(datos);
    modalmsj("Editar", "" +
        "<label for='descuento'>Descuento Global</label>" +
        "<input id='descuento' type='number' value='" + datos["descuentoFactura"] + "'>" +
        "<div class='modal-footer'>" +
        "    <a href='#!' class='modal-action modal-close waves-effect  btn-flat' id='actualizar'>Actualizar</a>" +
        "</div>"
    );
    $("#actualizar").click(function () {
        ajaxActualizar(datos["codFactura"], $("#descuento").val());
    });
}

function callbackActualizar(datos) {
    datos = JSON.parse(datos);
    if (datos["correcto"]) {
        listar();
    } else {
        toast(datos["mensaje"]);
    }
}