
function mostrar(id) {

    $("#opcionales").empty();

    if (id == "NOMPIEZA") {
        $("#divmodo").show();
        $("#opcionales").append("<label>Nombre: </label>");
        $("#opcionales").append("<input type='text' name='inombre' class='form-controls'/>");
    }

    if (id == "NUMPIEZA") {
        $("#divmodo").show();
        $("#opcionales").append("<label>Numero: </label>");
        $("#opcionales").append("<input type='text' name='inumero' class='form-controls'/>");
    }

    if (id == "PRECIOVENT") {
        $("#divmodo").hide();
        $("#opcionales").append("<label>Precio entre </label>");
        $("#opcionales").append("<input type='number' name='imenor' class='form-controls'/> Y");
        $("#opcionales").append(" <input type='number' name='imayor' class='form-controls'/> &euro;");

    }
}


function mostrarpedidos(id) {

    $("#opcionales").empty();

    if (id == "NUMPEDIDO") {
        $("#opcionales").append("<label>Numero de pedido: </label>");
        $("#opcionales").append("<input type='text' name='NUMPEDIDO' class='form-controls'/>");
    }

    if (id == "FECHA") {
        $("#opcionales").append("<label>Fecha: </label>");
        $("#opcionales").append("<input type='date' name='FECHA' class='form-controls'/>");
    }

    if (id == "NUMPIEZA") {
        $("#opcionales").append("<label>Numero de pieza: </label>");
        $("#opcionales").append("<input type='text' name='NUMPIEZA' class='form-controls'/>");
    }

    if (id == "NOMPIEZAYCANTIDAD") {
        $("#opcionales").append("<label>Nombre de pieza: </label>");
        $("#opcionales").append("<input type='text' name='NOMPIEZA' class='form-controls'/>");

        $("#opcionales").append("<br/><label>Cantidad de pieza: </label>");
        $("#opcionales").append("<input type='text' name='CANTIDAD' class='form-controls'/>");
    }

}