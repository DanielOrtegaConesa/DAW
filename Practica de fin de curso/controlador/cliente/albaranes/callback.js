function callbackListar(datos) {
    // console.log(datos);
    $("#tb").empty();
    datos = JSON.parse(datos);
    //  console.log(datos);
    max = datos.fin;

    let resultados = datos.resultados;
    for (let c in datos.resultados) {

        let ver = "<td>   <a class='btn-floating btn-large waves-effect waves-light blue lighten-1' id='" + resultados[c]["codAlbaran"] + "Ver'><i class='material-icons'>open_in_new</i></a> </td>";
        let estado = "Facturado";
        if (resultados[c]["borrable"]) {
            estado = "Sin Facturar"
        }

        $("#tb").append(
            "<tr>" +
            "<td> " + resultados[c]["codPedido"] + "</td>" +
            "<td> " + resultados[c]["codAlbaran"] + "</td>" +
            "<td>" + resultados[c]["cantidadArticulos"] + "</td>" +
            "<td>" + estado + "</td>" +
            "<td>" + resultados[c]["fecha"] + "</td>" +
            ver +
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
