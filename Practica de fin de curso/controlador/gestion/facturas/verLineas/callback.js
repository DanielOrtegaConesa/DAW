function callbackListar(datos) {
    console.log(datos);
    $("#tb").empty();
    $("#tf").empty();
    datos = JSON.parse(datos);
    console.log(datos);
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

        let swit=  "  <div class=''>" +
            "    <label>" +
            "      " +
            "      Procesado" +

            "    </label>" +
            "  </div>";


            mye =
                "<td>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codPedido"] + resultados[c]["numLineaPedido"] + "Borrar'><i class='material-icons'>delete</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codPedido"] + resultados[c]["numLineaPedido"] + "Editar'><i class='material-icons'>mode_edit</i></a>" +
                "<td/>";


        $("#tb").append(
            "<tr>" +
            "<td> <img src='" + resultados[c]["img"] + "' class='imgarticulo'></td>" +
            "<td>" + resultados[c]["precio"] + "</td>" +
            "<td>" + resultados[c]["cantidad"] + "</td>" +
            "<td>" + resultados[c]["codAlbaran"] + "</td>" +
            "</tr>"
        );

    }
    $("#tf").append("<tr><td><h5>Total: " + total + "&euro;</h5></td></tr>");

    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackEditar(datos) {
    //console.log(datos);
    datos = JSON.parse(datos);
    console.log(datos);

    let datosselect = "";
    for (let c in datos.todoslosarticulos) {
        if (datos.todoslosarticulos[c]["codArticulo"] == datos.datosLinea["codArticulo"]) {
            datosselect += "<option value='" + datos.todoslosarticulos[c]["codArticulo"] + "' selected>" + datos.todoslosarticulos[c]["nombre"] + "</option>";
        } else {
            datosselect += "<option value='" + datos.todoslosarticulos[c]["codArticulo"] + "'>" + datos.todoslosarticulos[c]["nombre"] + "</option>";
        }
    }

    $("#modalmensajes").remove();
    $("body").append(
        " <div id='modalmensajes' class='modal bigmodal'>" +
        "    <div class='modal-content row'>" +
        "      <h4> Editar </h4>" +

        "   <form id='datos'>" +
        "        <div class='col s12 m4'>" +
        "            <label for='codArticulo'>Articulo</label>" +
        "            <select id='codArticulo'> " +
        datosselect +
        "            </select>" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='cantidad'>Cantidad</label>" +
        "            <input type='number' id='cantidad' value='" + datos["datosLinea"]["cantidad"] + "'/> " +
        "        </div>" +
        "   </form>" +


        "<div class='modal-footer'>" +
        "    <a href='#!' class='modal-action modal-close waves-effect  btn-flat' id='actualizar'>Actualizar</a>" +
        "</div>" +

        "</div>" +
        "");


    $("#actualizar").on("click", function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/pedidos/verLineas/listar.php",
            data: {
                "accion": "actualizar",
                "codPedido": datos.datosLinea.codPedido,
                "numLineaPedido": datos.datosLinea.numLineaPedido,
                "cantidad": $("#cantidad").val(),
                "codArticulo": $("#codArticulo").val()
            },
            success: function (data) {
                callbackActualizar(data);
            }
        });
    });

    $("select").material_select();
    $('#modalmensajes').modal();
    $('#modalmensajes').modal('open');
}

function callbackActualizar(datos) {
    console.log(datos);
    verEstadisticas();
}

function callbackProcesar(datos) {
    verEstadisticas();
    console.log(datos);
}