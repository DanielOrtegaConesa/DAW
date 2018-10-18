"use strict";

function Producto(nom, pre) {
    if (this === window) {
        return new Producto(nom, pre);
    }

    var nombre = nom;
    var precio = pre;
    var cantidad = 0;
    var alquileres = [];
    var devoluciones = [];
    var estados = [];


    this.Alquilar = function (fecha) {
        alquileres.push(fecha);
    }

    this.getAlquileres = function () {
        return alquileres;
    }
    this.getAlquiler =  function (pos) {
        return alquileres[pos];
    }

    this.getUltimoAlquiler = function () {
        return alquileres[alquileres.length-1];
    }

    this.setCantidad = function (can) {
        cantidad = can;
        this.removerestados();

    }

    this.getCantidad = function () {
        return cantidad;
    }

    this.setEstado = function (pos, est) {
        estados[pos] = est;
    }
    this.getEstado = function (pos) {
        return estados[pos];
    }

    this.getEstados = function () {
        return estados;
    }
    this.setNombre = function (nom) {
        if (escadena(nom)) {
            nombre = nom;
        } else {
            return false;
        }
    }
    this.getNombre = function () {
        return nombre;
    }

    this.setPrecio = function (pre) {
        if (espositivo(pre)) {
            precio = pre;
            return true;
        } else {
            return false;
        }
    }

    this.getPrecio = function () {
        return precio;
    }

    this.removerestados = function () {
        estados = [];
        for (let c = 0; c != cantidad; c++) {
            estados.push("libre");
        }
    }

    this.contaralquilados = function () {
        let total = 0;
        for (let indice in estados) {
            if (!estados[indice].indexOf("alquilado")) {
                total++
            }
        }
        return total;
    }

    this.contarlibres = function () {
        let total = 0;
        for (let indice in estados) {
            if (!estados[indice].indexOf("libre")) {
                total++
            }
        }
        return total;
    }
    this.nuevaDevolucion = function (fecha) {
        devoluciones.push(fecha);
    }
    this.getDevolucion = function (pos) {
        return devoluciones[pos];
    }
    this.getDevoluciones = function () {
        return devoluciones;
    }
    this.ultimaDevolucion = function () {
        let ultima = devoluciones[devoluciones.length - 1]
        if (ultima == undefined) {
            ultima = "Nunca";
        }
        return ultima;
    }

}