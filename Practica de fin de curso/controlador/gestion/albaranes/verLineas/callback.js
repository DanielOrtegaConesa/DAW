function callbackListar(datos) {
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


        if (resultados[c]["mye"]) {
             mye =
                "<td>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codAlbaran"] + resultados[c]["numLineaAlbaran"] + "Borrar'><i class='material-icons'>delete</i></a>" +
                "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["codAlbaran"] + resultados[c]["numLineaAlbaran"] + "Editar'><i class='material-icons'>mode_edit</i></a>" +
                "<td/>";
        }

        $("#tb").append(
            "<tr>" +
            "<td> <img src='" + resultados[c]["img"] + "' class='imgarticulo'></td>" +
            "<td> " + resultados[c]["nombre"] + "</td>" +
            "<td>" + resultados[c]["precio"] + "</td>" +
            "<td>" + resultados[c]["cantidad"] + "</td>" +
            "<td>" + resultados[c]["precio"] * resultados[c]["cantidad"] + "</td>" +
            "<td>" + resultados[c]["iva"] + "</td>" +
            mye +
            "</tr>"
        );

        ajaxEliminar("#" + resultados[c]["codAlbaran"] + resultados[c]["numLineaAlbaran"] + "Borrar", resultados[c]["codAlbaran"], resultados[c]["numLineaAlbaran"]);
        ajaxEditar("#" + resultados[c]["codAlbaran"] + resultados[c]["numLineaAlbaran"] + "Editar", resultados[c]["codAlbaran"], resultados[c]["numLineaAlbaran"]);

    }
    $("#tf").append("<tr><td><h5>Total: " + total + "&euro;</h5></td></tr>");

    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackEditar(datos) {
    //console.log(datos);
    datos = JSON.parse(datos);
    //console.log(datos);

    $("#modalmensajes").remove();
    $("body").append(
        " <div id='modalmensajes' class='modal bigmodal'>" +
        "    <div class='modal-content row'>" +
        "      <h4> Editar </h4>" +

        "   <form id='datos'>" +
        "        <div class='col s12 m4'>" +
        "            <label for='precio'>Precio</label>" +
        "            <input type='number' id='precio' value='" + datos["datosLinea"]["precio"] + "'/> " +
        "            </select>" +
        "        </div>" +
        "        <div class='col s12 m4'>" +
        "            <label for='iva'>IVA</label>" +
        "            <input type='number' id='iva' value='" + datos["datosLinea"]["iva"] + "'/> " +
        "        </div>" +
        "        <div class='col s12 m4'>" +
        "            <label for='descuento'>Descuento</label>" +
        "            <input type='number' id='descuento' value='" + datos["datosLinea"]["descuento"] + "'/> " +
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
            url: "controlador/gestion/albaranes/verLineas/acciones.php",
            data: {
                "accion": "actualizar",
                "codAlbaran": datos.datosLinea.codAlbaran,
                "numLineaAlbaran": datos.datosLinea.numLineaAlbaran,
                "precio": $("#precio").val(),
                "descuento": $("#descuento").val(),
                "iva": $("#iva").val()
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
    datos = JSON.parse(datos);
    if(datos["correcto"]){
        listar();
    }else{
        toast(datos["mensaje"]);
    }

}