function esblanco(dato) {
    if (dato == "") {
        return true;
    } else {
        return false;
    }
}

function esnumero(numero) {
    var correcto = true;
    for (let c = 0; c < numero.length && correcto; c++) {
        if ((numero.codePointAt(c)) >= 48 && (numero.codePointAt(c) <= 57)) {
        } else {
            correcto = false;
        }
    }
    return correcto;
}

function escadena(dato) {
    if (esblanco(dato)) {
        return false;
    } else {
        if (isNaN(dato)) {
            return true;
        } else {
            return false;
        }
    }
}

function espositivo(dato) {
    if (esnumero(dato)) {
        if (dato > 0) {
            return true;
        }
    } else {
        return false;
    }
}

function aleatorio(minincl, maxincl) {
    return (Math.random() * (maxincl - minincl) + minincl).toFixed();
}


function pideDato(peticion, dato) {
    dato = dato.toUpperCase();

    switch (dato) {
        case "N":
            do {
                var numero = prompt(peticion);
            } while (!esnumero(numero)) ;
            return numero;
            break;
        case "S":
            do {
                var texto = prompt(peticion);
            } while (!escadena(texto)) ;
            return texto;
            break;
    }
}


function reemplazar(frase, busca, reemplaza) {
    var resultado = "";
    for (var c = 0; c < frase.length; c++) {
        if (frase[c] != busca) {
            resultado += frase[c];
        } else {
            resultado += reemplaza;
        }
    }
    return resultado;
}

function decimalabinario(numero) {
    return numero.toString(2);
}

function binarioadecimal(numerostring) {
    return parseInt(numero, 2);
}

function reemplazarposicion(texto, posicion, reemplazo) {
    var resultado = "";
    for (var c = 0; c < texto.length; c++) {
        if (c == posicion) {
            resultado += reemplazo;
        } else {
            resultado += texto[c];
        }
    }
    return resultado;
}