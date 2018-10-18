function esblanco(dato) {
    if (dato == "") {
        return true;
    } else {
        return false;
    }
}

function esnumero(dato) {
    if (esblanco(dato)) {
        return false;
    } else {
        if (!isNaN(dato)) {
            return true;
        } else {
            return false;
        }
    }
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

function aleatorio(min, max) {
    return Math.random() * (max - min) + min;
}

function pidenumero() {
    do {
        var numero = prompt("Introduce un numero:");
    } while (esnumero(numero) != true);
    return numero;
}