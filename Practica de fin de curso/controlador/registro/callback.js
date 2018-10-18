function callbackRegistro(datos) {
    grecaptcha.reset();
    datos = JSON.parse(datos);

    if (datos.correcto) {
        toast("Solicitud enviada");
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