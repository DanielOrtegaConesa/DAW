"use strict";

function Cliente(nom) {
    if (this === window) {
        return new Cliente(nombre);
    }

    var nombre = nom;
    var productos = new Array();

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
    this.getProductos=function () {
        return productos;
    }

    this.getEstadoProducto = function (producto) {
        if (producto instanceof Juego || producto instanceof CD || producto instanceof Pelicula) {
            return producto.getEstado();
        }
        return false;
    }
    this.devolver = function (producto) {
        if (producto instanceof Juego || producto instanceof CD || producto instanceof Pelicula) {
            if (producto.getEstado() === "alquilado") {
                producto.setEstado("libre");
                return true;
            }
        }
        return false;
    }

    this.nuevoAlquilerCliente = function (producto) {
        if (producto instanceof Juego || producto instanceof CD || producto instanceof Pelicula) {
            productos.push(producto);
            return true;
        }
        return false;
    }

    this.verLoAlquilado = function () {
        var texto = "";
        for (let indice of productos) {
            texto += "Nombre: " + indice.getNombre() + "   |   Estado: " + indice.getEstado() + "\n";
        }
        window.alert("Productos alquilados:\n" + texto);
    }


}