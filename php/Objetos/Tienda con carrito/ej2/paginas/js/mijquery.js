function mpsum(id) {

    $("#opcionales").empty();

    if (id == "NUMPIEZA") {
        $("#opcionales").append("<label>Numero de pieza: </label>");
        $("#opcionales").append("<input type='text' name='NUMPIEZA' class='form-controls'/>");
    }

    if (id == "NUMVEND") {
        $("#opcionales").append("<label>Numero de vendedor: </label>");
        $("#opcionales").append("<input type='number' name='NUMVEND' class='form-controls'/>");
    }

    if (id == "NOMPIEZA") {
        $("#opcionales").append("<label>Nombre de pieza: </label>");
        $("#opcionales").append("<input type='text' name='NOMPIEZA' class='form-controls'/>");
    }

    if (id == "NOMVEND") {
        $("#opcionales").append("<label>Nombre de vendedor: </label>");
        $("#opcionales").append("<input type='text' name='NOMVEND' class='form-controls'/>");
    }

    if (id == "PROVINCIA") {
        $("#opcionales").append("<label>Provincia del vendedor: </label>");
        $("#opcionales").append("<input type='text' name='PROVINCIA' class='form-controls'/>");
    }

    if (id == "rprecio") {
        $("#opcionales").append("<label>Precio entre </label>");
        $("#opcionales").append("<input type='number' name='imenor' class='form-controls'/> Y");
        $("#opcionales").append(" <input type='number' name='imayor' class='form-controls'/> &euro;");
    }
}

function mvend(id) {

    $("#opcionales").empty();

    if (id == "NUMVEND") {
        $("#opcionales").append("<label>Numero: </label>");
        $("#opcionales").append("<input type='number' name='dato' class='form-controls'/>");
    }

    if (id == "NOMVEND") {
        $("#opcionales").append("<label>Nombre: </label>");
        $("#opcionales").append("<input type='text' name='dato' class='form-controls'/>");
    }

    if (id == "NOMBRECOMER") {
        $("#opcionales").append("<label>Comercio: </label>");
        $("#opcionales").append("<input type='text' name='dato' class='form-controls'/>");
    }

    if (id == "TELEFONO") {
        $("#opcionales").append("<label>Telefono: </label>");
        $("#opcionales").append("<input type='number' name='dato' class='form-controls'/>");
    }

    if (id == "CALLE") {
        $("#opcionales").append("<label>Calle: </label>");
        $("#opcionales").append("<input type='text' name='dato' class='form-controls'/>");
    }

    if (id == "CIUDAD") {
        $("#opcionales").append("<label>Ciudad: </label>");
        $("#opcionales").append("<input type='text' name='dato' class='form-controls'/>");
    }

    if (id == "PROVINCIA") {
        $("#opcionales").append("<label>Provincia: </label>");
        $("#opcionales").append("<input type='text' name='dato' class='form-controls'/>");
    }

    if (id == "COD_POSTAL") {
        $("#opcionales").append("<label>Codigo Postal: </label>");
        $("#opcionales").append("<input type='number' name='dato' class='form-controls'/>");
    }

}

function mpieza(id) {

    $("#opcionales").empty();

    if (id == "NOMPIEZA") {
        $("#opcionales").append("<label>Nombre: </label>");
        $("#opcionales").append("<input type='text' name='inombre' class='form-controls'/>");
    }

    if (id == "NUMPIEZA") {
        $("#opcionales").append("<label>Numero: </label>");
        $("#opcionales").append("<input type='text' name='inumero' class='form-controls'/>");
    }

    if (id == "PRECIOVENT") {
        $("#opcionales").append("<label>Precio entre </label>");
        $("#opcionales").append("<input type='number' name='imenor' class='form-controls'/> Y");
        $("#opcionales").append(" <input type='number' name='imayor' class='form-controls'/> &euro;");

    }
}