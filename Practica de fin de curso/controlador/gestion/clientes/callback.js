function callbackEditar(datos) {
    console.log(datos);
    datos = JSON.parse(datos);
    $("#modalmensajes").remove();
    $("body").append(
        " <div id='modalmensajes' class='modal bigmodal'>" +
        "    <div class='modal-content row'>" +
        "      <h4> Editar </h4>" +

        "   <form id='datos'>" +
        "        <div class='col s12 m4'>" +
        "            <label for='cod'>Codigo</label>" +
        "            <input" +
        "                  class='validate'" +
        "                   type='text'" +
        "                   id='cod'" +
        "                   name='pass'" +
        "                   value = '" + datos.codCliente + "' " +
        "                   disabled" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='dni' data-error = 'Debe tener menos de 50 caracteres' >DNI</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='dni'" +
        "                   name='dni'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.dni + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='domicilioSocial' data-error = 'Debe tener menos de 50 caracteres' >Domicilio Social</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='domicilioSocial'" +
        "                   name='domicilioSocial'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.domicilioSocial + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='razonSocial' data-error = 'Debe tener menos de 50 caracteres' >Razon Social</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='razonSocial'" +
        "                   name='razonSocial'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.razonSocial + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='ciudad' data-error = 'Debe tener menos de 50 caracteres' >Ciudad</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='ciudad'" +
        "                   name='ciudad'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.ciudad + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='email' data-error = 'Debe tener menos de 50 caracteres' >Email</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='email'" +
        "                   id='email'" +
        "                   name='email'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.email + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='telefono' data-error = 'Debe tener 9 numeros' >Telefono</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='tel'" +
        "                   id='telefono'" +
        "                   name='telefono'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.telefono + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='nick' data-error = 'Debe tener menos de 50 caracteres' >Nick</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='nick'" +
        "                   name='nick'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "                   value = '" + datos.nick + "' " +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='pass' data-error = 'Debe tener menos de 50 caracteres' >Contraseña</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='password'" +
        "                   id='pass'" +
        "                   name='pass'" +
        "                   pattern='.{0,50}'" +
        "                   data-length='50'" +
        "            />" +
        "        </div>" +
        "         <input type='hidden' name='accion' value='actualizar'>" +
        "         <input type='hidden' name='codCliente' value='" + datos.codCliente + "'>" +
        "   </form>" +
        "</div>" +


        "<div class='modal-footer'>" +
        "    <a class='waves-effect waves-light btn orange' id='baja' >Baja</a>" +
        "    <a href='#!' class='modal-action modal-close waves-effect  btn-flat' id='actualizar'>Actualizar</a>" +
        "</div>" +

        "</div>" +
        "");


    $("#actualizar").on("click", function () {
        let datos = $("#datos").serializeArray();
        datos = objectifyForm(datos);
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/clientes/acciones.php",
            data: datos,
            success: function (data) {
                callbackActualizar(data);
            }
        });
    });

    $("#baja").on("click", function () {
        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/clientes/acciones.php",
            data: {"accion":"baja","nick":datos.nick},
            success: function (data) {
                $('#modalmensajes').modal('close');
                listar();
            }
        });
    });


    $('#modalmensajes').modal();
    $('#modalmensajes').modal('open');
}

function callbackListar(datos) {
    $("#tb").empty();
    datos = JSON.parse(datos);
    //console.log(datos);
    max = datos.fin;
    let resultados = datos.resultados;
    for (let c in datos.resultados) {
        $("#tb").append(
            "<tr>" +
            "<td><img class='imgarticulo rounded' src='"+resultados[c]["img"]+"'></td>" +
            "<td>" + resultados[c]["nick"] + "</td>" +
            "<td>" + resultados[c]["email"] + "</td>" +
            "<td>" + resultados[c]["telefono"] + "</td>" +
            "<td>" + resultados[c]["dni"] + "</td>" +
            "<td>" + resultados[c]["razonSocial"] + "</td>" +
            "<td>" +
            "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["nick"] + "Editar'><i class='material-icons'>mode_edit</i></a>" +
            "   <a class='btn-floating btn-large waves-effect waves-light deep-purple lighten-1' id='" + resultados[c]["nick"] + "Seleccionar'><i class='material-icons'>pan_tool</i></a>" +
            "<td/>"+
            "</tr>"
        );

        $("#" + resultados[c]["nick"] + "Editar").click(function () {
            $.ajax({
                method: "GET",
                cache: false,
                url: "controlador/gestion/clientes/acciones.php",
                data: {"nick": resultados[c]["nick"], "accion": "editar"},
                success: function (datos) {
                    callbackEditar(datos);
                }
            })
        });

        $("#" + resultados[c]["nick"] + "Seleccionar").click(function () {
            $.ajax({
                method: "GET",
                cache: false,
                url: "controlador/gestion/clientes/acciones.php",
                data: {"nick": resultados[c]["nick"], "accion": "seleccionar"},
                success: function (datos) {
                    console.log(datos);
                    toast("Seleccionado");
                }
            })
        });

        muestrapag();
    }
    $("table").trigger("update"); // ACTUALIZA EL TABLESORTER, SI PONES $("table").tablesorter(); CUANDO YA SE HA ECHO, GUARDA CACHE Y TE REPITE COLUMNAS
}

function callbackActualizar(datos) {
    console.log(datos);
    datos = JSON.parse(datos);
    if (datos.correcto) {
        toast("Actualizado Correctamente");
        listar();
        //location.reload(true);
    } else {
        let errores = datos.errores;
        if (errores.length == 1) {
            toast(errores[0])
        } else {
            let titulo = "Su solicitud no se ha podido procesar";
            let texto = " <ul class=\"collection\">";
            for (let i in errores) {
                texto += "<li class=\"collection-item\">" + errores[i] + "</li>";
            }
            texto += "</ul>";
            modalmsj(titulo, texto);
        }
    }
}

function callbackAdd(datos) {
    console.log(datos);
    datos = JSON.parse(datos);
    if(datos.correcto) {
        listar();
        $('#modalmensajes').modal('close');
        toast("Añadido correctamente");
    } else {
        let errores = datos.errores;
        if(errores.length == 1){
            toast(errores[0])
        }else {
            let titulo = "Su solicitud no se ha podido procesar";
            let texto = " <ul class=\"collection\">";
            for (let i in errores) {
                texto += "<li class=\"collection-item\">" + errores[i] + "</li>";
            }
            texto += "</ul>";
            modalmsj(titulo, texto);
        }
    }
}