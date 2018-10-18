function callbackListar(datos) {
    console.log(datos);
    $("#tb").empty();
    datos = JSON.parse(datos);
    max = datos.fin;

    let resultados = datos.resultados;
    for (let c in datos.resultados) {
        let generadoPorCliente = "No";
        if (resultados[c]["generadoPorCliente"] == 1) {
            generadoPorCliente = "Si";
        }

        let borrar = "<td>   <a class='btn-floating btn-large waves-effect waves-light blue lighten-1' id='" + resultados[c]["codPedido"] + "Ver'><i class='material-icons'>open_in_new</i></a> </td>";
        if (resultados[c]["borrable"]) {
            borrar =
                "<td>" +
                "   <a class='btn-floating btn-large waves-effect waves-light blue lighten-1' id='" + resultados[c]["codPedido"] + "Ver'><i class='material-icons'>open_in_new</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light blue lighten-1' id='" + resultados[c]["codPedido"] + "Borrar'><i class='material-icons'>delete</i></a>" +
                "<td/>";
        }

        $("#tb").append(
            "<tr>" +
            "<td>" + generadoPorCliente + "</td>" +
            "<td>" + resultados[c]["codPedido"] + "</td>" +
            "<td>" + resultados[c]["cantidadArticulos"] + "</td>" +
            "<td>" + resultados[c]["estado"] + "</td>" +
            "<td>" + resultados[c]["fecha"] + "</td>" +
            borrar +
            "</tr>"
        );


        ajaxEliminar("#" + resultados[c]["codPedido"] + "Borrar", resultados[c]["codPedido"]);
        $("#" + resultados[c]["codPedido"] + "Ver").click(function () {
            var redirectWindow = window.open('index.php?page=verLineasPedidos&codPedido='+resultados[c]["codPedido"]+'', '_blank');
            redirectWindow.location;
        });
        muestrapag();

    }
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}
