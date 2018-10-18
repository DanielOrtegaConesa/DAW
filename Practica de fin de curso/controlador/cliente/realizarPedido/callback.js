function callbackVerCarrito(datos) {
    $("#tb").empty();
    datos = JSON.parse(datos);
    max = datos.fin;
    let resultados = datos.resultados;
    for (let c in datos.resultados) {
        $("#tb").append(
            "<tr>" +
            "<td> <img src=' " + resultados[c]["img"] + "' class='imgarticulo'></td>" +
            "<td>" + resultados[c]["nombre"] + "</td>" +
            "<td>" + resultados[c]["precio"] + "</td>" +
            "<td ><input type='number' value='" + resultados[c]["cantidad"] + "' id='" + resultados[c]["codArticulo"] + "CambiarCantidad'></td>" +
            "<td> <a class='btn-floating btn-large waves-effect waves-light blue lighten-1' id='" + resultados[c]["codArticulo"] + "Eliminar'><i class='material-icons'>close</i></a></td>" +
            "</tr>"
        );
        ajaxEliminar("#" + resultados[c]["codArticulo"] + "Eliminar", resultados[c]["codArticulo"]);
        ajaxCambiarCantidad("#" + resultados[c]["codArticulo"] + "CambiarCantidad", resultados[c]["codArticulo"]);
    }


$("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackCambiarCantidad(datos) {
    datos = JSON.parse(datos);
    if (datos.correcto) {
        toast("Cambio realizado");
    } else {
        toast("Ningun cambio realizado");
    }
}

function callbackTramitarPedido(datos) {
   /// console.log(datos);
    datos = JSON.parse(datos);
    if (datos.correcto) {
        toast("Pedido realizado");
        listar();
    } else {
        toast("No hemos podido procesar su pedido");
    }
}