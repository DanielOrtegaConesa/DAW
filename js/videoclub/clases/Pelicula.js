"use strict";

function Pelicula(nom, idi, gen, dur) {
    if (this === window) {
        return new Pelicula(nom, idi, gen, dur);
    }
    Producto.call(this, nom, 2);
    var idioma = idi;
    var genero = gen;
    var duracion = dur;

    this.setIdioma = function (idi) {
        if (escadena(idi)) {
            idioma = idi;
            return true;
        } else {
            return false;
        }
    }
    this.getIdioma = function () {
        return idioma;
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