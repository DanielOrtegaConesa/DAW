$("#datos").submit(function (event) {
    event.preventDefault();
    let nick = $("#nick").val();
    let pass = $("#pass").val();
    let tipo = $("#tipo").val();

    $.ajax({
        method:"POST",
        cache: false,
        url:"controlador/login/login.php",
        data: {
            'response': grecaptcha.getResponse(),
            "nick": nick,
            "pass": pass,
            "tipo":tipo
        },
        success: function(data){
            callbackLogin(data);
        }
    });
})
