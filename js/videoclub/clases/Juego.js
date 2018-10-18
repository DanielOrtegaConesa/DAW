"use strict";

function Juego(nom, pla, gen) {
    if (this === window) {
        return new Juego(nom, pla, gen);
    }
    Producto.call(this, nom, 3);
    var plataforma = pla;
    var genero = gen;

    this.setPlataforma = function (pla) {
        if (escadena(pla)) {
            plataforma = pla;
            return true;
        } else {
            return false;
        }
    }
    this.getPlataforma = function () {
        return plataforma;
    }

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


}