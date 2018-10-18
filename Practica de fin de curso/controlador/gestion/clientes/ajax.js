$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/clientes/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
}



$("#tbuscar,#cbuscar").change(function () {
    pag = 0;
    let tbuscar = $("#tbuscar").val();
    let cbuscar = $("#cbuscar").val();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/clientes/listar.php",
        data: {"pag": pag, "tbuscar": tbuscar,"cbuscar":cbuscar},
        success: function (datos) {
            callbackListar(datos);
        }
    });
})


$("#addperson").on("click",function () {
    $("#modalmensajes").remove();
    $("body").append(
        "<div id='modalmensajes' class='modal bigmodal'>" +
        "    <div class='modal-content row'>" +
        "      <h4> Añadir </h4>" +

        "        <form id='datos'>" +
        "        <div class='col s12 m4'>" +
        "            <label for='dni' >DNI</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='dni'" +
        "                   name='dni'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='domicilioSocial'>Domicilio Social</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='domicilioSocial'" +
        "                   name='domicilioSocial'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='razonSocial' >Razon Social</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='razonSocial'" +
        "                   name='razonSocial'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='ciudad' >Ciudad</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='ciudad'" +
        "                   name='ciudad'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='email' >Email</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='email'" +
        "                   id='email'" +
        "                   name='email'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='telefono' >Telefono</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='tel'" +
        "                   id='telefono'" +
        "                   name='telefono'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='nick' >Nick</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='text'" +
        "                   id='nick'" +
        "                   name='nick'" +
        "            />" +
        "        </div>" +

        "        <div class='col s12 m4'>" +
        "            <label for='pass'>Contraseña</label>" +
        "            <input" +
        "                  class='input-field validate'" +
        "                   type='password'" +
        "                   id='pass'" +
        "                   name='pass'" +
        "            />" +
        "        </div>" +
        "         <input type='hidden' name='accion' value='add'>" +
        "   </form>" +
        "</div>" +


        "<div class='modal-footer'>" +
        "    <a href='#!' class='modal-action modal-close waves-effect  btn-flat' id='add'>Añadir</a>" +
        "</div>" +

        "</div>" +
        "");

    $("#add").click(function () {
        let datos = $("#datos").serializeArray();
        datos = objectifyForm(datos);

        $.ajax({
            method: "GET",
            cache: false,
            url: "controlador/gestion/clientes/acciones.php",
            data:datos,
            success: function (d) {
               callbackAdd(d);
            }
        });
    });

    $('#modalmensajes').modal();
    $('#modalmensajes').modal('open');
});

$("#menos").click(function () {
    pmenos();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/clientes/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});

$("#mas").click(function () {
    pmas();
    $.ajax({
        method: "GET",
        cache: false,
        url: "controlador/gestion/clientes/listar.php",
        data: {"pag": pag},
        success: function (datos) {
            callbackListar(datos);
        }
    });
});