"use strict";

function Videoclub(nom) {
    if (this === window) {
        return new Videoclub(nombre);
    }
    var nombre = nom;
    var clientes = new Array();
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

    this.setCliente = function (cliente) {
        if (cliente instanceof Cliente) {
            clientes.push(cliente);
            return true;
        }
        return false;
    }

    this.getClientes = function () {
        return clientes;
    }
    this.getCliente = function (cliente) {
        for (let indice of clientes) {
            if (clientes[indice].getNombre() == cliente) {
                return indice;
            }
        }
        return false;
    }

    this.getProductos = function () {
        return productos;
    }
    this.getProducto = function (producto) {
        for (let indice of productos) {
            if (indice.getNombre() == producto) {
                return indice;
            }
        }
        return false;
    }
    this.setProducto = function (producto) {
        if (producto instanceof Juego || producto instanceof CD || producto instanceof Pelicula) {
            productos.push(producto);
            return true;
        }
        return false;
    }

    this.nuevoAlquilerVideoclub = function (producto, cliente) {
        if (producto instanceof Juego || producto instanceof CD || producto instanceof Pelicula) {
            cliente.nuevoAlquilerCliente((producto));
            return true;
        }
        return false;
    }

    this.imprimirAlquilados = function () {
        var texto = "";
        for (let indice of productos) {
            if (indice.getEstado() === "alquilado") {
                texto += indice.getNombre() + "\n";
            }
        }
        alert("Productos:\n" + texto);
    }

    this.imprimirLibres = function () {
        var texto = "";
        for (let indice of productos) {
            if (indice.getEstado() === "libre") {
                texto += indice.getNombre() + "\n";
            }
        }
        alert("Productos:\n" + texto);
    }
}