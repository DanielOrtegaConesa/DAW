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
        if (isNaN(dato) && dato.indexOf("|") == -1) {
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

function pidenumero() {
    do {
        var numero = prompt("Introduce un numero:");
    } while (esnumero(numero) != true);
    return numero;
}

function seleccionavariable(p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25) {
    var todas = p1 + "|" + p2 + "|" + p3 + "|" + p4 + "|" + p5 + "|" + p6 + "|" + p7 + "|" + p8 + "|" + p9 + "|" + p10 + "|" + p11 + "|" + p12 + "|" + p13 + "|" + p14 + "|" + p15 + "|" + p16 + "|" + p17 + "|" + p18 + "|" + p19 + "|" + p20 + "|" + p21 + "|" + p22 + "|" + p23 + "|" + p24 + "|" + p25 + "|";
    var n = aleatorio(0, 24);
    var barra;
    //alert("Todas: " + todas);
    for (var c = 0; c < n; c++) {
        barra = todas.indexOf("|");
        //  alert("Posicion barra: " + barra);
        todas = todas.substr(barra - (todas.length));
        todas = todas.substr(1);
        //     alert(todas);
    }
    todas = todas.substr(0, todas.indexOf("|"));
    // alert("fin: "+todas);
    return todas.toUpperCase();
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

