function callbackListar(datos) {
    console.log(datos);
    $("#tf").empty();
    $("#tb").empty();
    datos = JSON.parse(datos);
    max = datos.fin;

    let resultados = datos.resultados;
    let total = 0;

    for (let c in datos.resultados) {
        total += resultados[c]["precio"] * resultados[c]["cantidad"];

        let generadoPorCliente = "No";
        if (resultados[c]["generadoPorCliente"] == 1) {
            generadoPorCliente = "Si";
        }

        let mye = "<td></td>";



        $("#tb").append(
            "<tr>" +
            "<td> <img src='" + resultados[c]["img"] + "' class='imgarticulo'></td>" +
            "<td> " + resultados[c]["nombre"] + "</td>" +
            "<td>" + resultados[c]["precio"] + "</td>" +
            "<td>" + resultados[c]["cantidad"] + "</td>" +
            "<td>" + resultados[c]["precio"] * resultados[c]["cantidad"] + "</td>" +
            "<td>" + resultados[c]["iva"] + "</td>" +
            "</tr>"
        );
    }
    $("#tf").append("<tr><td><h5>Total: " + total + "&euro;</h5></td></tr>");

    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}


function callbackActualizar(datos) {
    //console.log(datos);
    listar();
}