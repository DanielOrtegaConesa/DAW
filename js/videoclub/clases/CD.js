"use strict";

function CD(nom) {
    if (this === window) {
        return new CD(nom);
    }
    Producto.call(this, nom, 1);
    var duracion = 0;
    var genero = "";

    this.setGenero = function (gen) {
        if (escadena(gen)) {
            genero = gen;
            return true;
        } else {
            return false;
        }
    }
    this.getGenero = function () {
        return genero;
    }

    this.setDuracion = function (dur) {
        if (espositivo(dur)) {
            duracion = dur;
            return true;
        } else {
            return false;
        }
    }
    this.getDuracion = function () {
        return duracion;
    }

}