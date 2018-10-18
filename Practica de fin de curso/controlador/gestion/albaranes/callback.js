function callbackListar(datos) {
    $("#tb").empty();
    datos = JSON.parse(datos);
    //  console.log(datos);
    max = datos.fin;

    let resultados = datos.resultados;
    for (let c in datos.resultados) {

        let facturar = "<td>Facturado</td>";
        let borrar = "<td>   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codAlbaran"] + "Ver'><i class='material-icons'>open_in_new</i></a> </td>";
        if (resultados[c]["borrable"]) {
            facturar = "  " +
                "<td>" +
                "<div class='switch'>" +
                "    <label>" +
                "      No" +
                "      <input type='checkbox' name='afacturar' value='" + resultados[c]["codAlbaran"] + "'>" +
                "      <span class='lever'></span>" +
                "      Si" +
                "    </label>" +
                "</div>" +
                "</td>";

            borrar =
                "<td>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codAlbaran"] + "Ver'><i class='material-icons'>open_in_new</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codAlbaran"] + "Borrar'><i class='material-icons'>delete</i></a>" +
                "<td/>";
        }


        $("#tb").append(
            "<tr>" +
            facturar +
            "<td> " + resultados[c]["nick"] + "</td>" +
            "<td> " + resultados[c]["codPedido"] + "</td>" +
            "<td> " + resultados[c]["codAlbaran"] + "</td>" +
            "<td>" + resultados[c]["cantidadArticulos"] + "</td>" +
            "<td>" + resultados[c]["fecha"] + "</td>" +
            borrar +
            "</tr>"
        );


        ajaxEliminar("#" + resultados[c]["codAlbaran"] + "Borrar", resultados[c]["codAlbaran"]);
        $("#" + resultados[c]["codAlbaran"] + "Ver").click(function () {
            var redirectWindow = window.open('index.php?page=verLineasAlbaranes&codAlbaran=' + resultados[c]["codAlbaran"] + '', '_blank');
            redirectWindow.location;
        });
        muestrapag();

    }
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackFacturar(datos) {
    datos = JSON.parse(datos);
    if (!datos.correcto) {
        if (datos.mensaje != "") {
            toast(datos.mensaje);
        }
    }
    listar();
}
