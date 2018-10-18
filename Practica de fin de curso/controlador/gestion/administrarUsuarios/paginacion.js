let pag = 0;
let max = 1;

function pmenos() {
    pag--;
    if (pag < 0) {
        pag = 0;
        toast("Has llegado a la primera pagina");
    }
}

function pmas() {
    pag++;
    if (pag > max - 1) {
        pag = max - 1;
        toast("Has llegado a la ultima pagina");
    }
}

function muestrapag() {
    $("#muestrapag").html(pag + 1);
}