$("#datos").submit(function (event) {
    event.preventDefault();
    let dni = $("#dni").val();
    let razonSocial = $("#razonSocial").val();
    let domicilioSocial = $("#domicilioSocial").val();
    let ciudad = $("#ciudad").val();
    let email = $("#email").val();
    let telefono = $("#telefono").val();
    let nick = $("#nick").val();
    let pass = $("#pass").val();


    $.ajax({
        type: "POST",
        cache: false,
        url: "controlador/registro/registro.php",
        data: {
            'response': grecaptcha.getResponse(),
            "dni": dni,
            "razonSocial": razonSocial,
            "domicilioSocial": domicilioSocial,
            "ciudad": ciudad,
            "email": email,
            "telefono": telefono,
            "nick": nick,
            "pass": pass
        },
        success: callbackRegistro
    });
})
