function callbackListar(datos) {
    $("#contenedorArticulos").empty();
    datos = JSON.parse(datos);
    max = datos.fin;
    let resultados = datos.resultados;
    for (let c in datos.resultados) {
        $("#contenedorArticulos").append(" " +
            "<div class='card col s12 m6 l4'>" +
            "    <div class='center waves-effect waves-block waves-light'>" +
            "      <img class='activator imgarticulo' src='" + resultados[c]["img"] + "'>" +
            "    </div>" +
            "    <div class='card-content'>" +
            "      <span class='card-title activator grey-text text-darken-4'>" + resultados[c]["nombre"] + "<i class='material-icons right'>more_vert</i></span>" +
            "      <p>" + resultados[c]["precio"] + "&euro;</p>" +
            "    </div>" +
            "    <div class='card-reveal'>" +
            "      <span class='card-title grey-text text-darken-4'><i class='material-icons right'>close</i></span>" +
            "      <p  class='flow-text'>" + resultados[c]["descripcion"] + "</p  class='flow-text'>" +
            "    </div>" +
            " <div class='card-action'>" +
            "<a class='dedito' id='" + resultados[c]["codArticulo"] + "'>Añadir al carrito</a>" +
            "</div>" +
            "  </div>" +
            "</div>"
        );
        muestrapag();

        $("#" + resultados[c]["codArticulo"]).click(function () {
            $.ajax({
                method: "GET",
                cache: false,
                url: "controlador/gestion/articulos/acciones.php",
                data: {"accion": "add", "codArticulo": resultados[c]["codArticulo"]},
                success: function (datos) {
                    //     console.log(datos)
                    datos = JSON.parse(datos);
                    if (datos.correcto) {
                        toast("Añadido");
                    } else {
                        toast("Ha ocurrido un error");
                    }
                }
            });
        })
    }
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}
