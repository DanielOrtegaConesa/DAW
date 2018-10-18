$(document).ready(function () {
    $("#disparadorlateral").sideNav();
    $("select").material_select();
    try {
        $("table").tablesorter();
    }catch (excepcion){}
});

function objectifyForm(formArray) {//serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function modalmsj(titulo, contenido) {
    $("#modalmensajes").remove();
    $("body").append(
        " <div id='modalmensajes' class='modal'>" +
        "    <div class='modal-content'>" +
        "      <h4>" + titulo + "</h4>" +
        "      <p>" + contenido + "</p>" +
        "    </div>" +
        "  </div>" +
        "");
    $('#modalmensajes').modal();
    $('#modalmensajes').modal('open');
}

function bigmodalmsj(titulo, contenido) {
    $("#modalmensajes").remove();
    $("body").append(
        " <div id='modalmensajes' class='modal bigmodal'>" +
        "    <div class='modal-content'>" +
        "      <h4>" + titulo + "</h4>" +
        "      <p>" + contenido + "</p>" +
        "    </div>" +
        "  </div>" +
        "");
    $('#modalmensajes').modal();
    $('#modalmensajes').modal('open');
}

function toast(texto) {
    Materialize.Toast.removeAll();
    Materialize.toast(texto, 4000);
}
