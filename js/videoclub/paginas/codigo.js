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

/* FUNCIONES ESPECIFICAS DE ESTA PRACTICA */

var videoclubs = [];
var cuerpo = document.getElementById("cuerpo");
var comentarios = document.getElementById("comentarios");

function ponerinicio() {
    cuerpo.innerHTML = "<p>\n" +
        "                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque consequat hendrerit commodo. Etiam\n" +
        "                rutrum\n" +
        "                quis diam euismod pellentesque. Integer vestibulum dolor metus, vel venenatis nibh rhoncus non. Quisque\n" +
        "                convallis lobortis nunc, sed fringilla ante imperdiet sit amet. Integer ullamcorper pretium nulla\n" +
        "                feugiat\n" +
        "                porta. In in vestibulum diam. Sed feugiat vestibulum ex eget malesuada. Duis placerat ut lectus nec\n" +
        "                vulputate. Nam quis augue at tortor bibendum fermentum a sed sem. Curabitur aliquet odio vitae lacus\n" +
        "                congue\n" +
        "                mollis. Nunc suscipit hendrerit venenatis. Aliquam leo felis, ornare vitae imperdiet nec, accumsan a\n" +
        "                odio.\n" +
        "                Etiam a semper justo. Ut quis tristique tellus. Integer viverra, arcu eget rutrum efficitur, erat tortor\n" +
        "                rhoncus nunc, vitae sollicitudin nisl lectus ut magna. Aenean sit amet leo id urna mollis finibus\n" +
        "                suscipit\n" +
        "                sed tellus.\n" +
        "            </p>\n" +
        "\n" +
        "            <p>\n" +
        "                Pellentesque dapibus faucibus orci et iaculis. Vestibulum semper mattis augue eget bibendum. Etiam\n" +
        "                bibendum massa sit amet pulvinar aliquet. Nulla non egestas libero. Praesent ultricies dui quis libero\n" +
        "                malesuada gravida. Donec commodo diam nisi, ut egestas libero commodo et. Aenean lobortis risus vel\n" +
        "                ornare congue. Donec eu velit ultrices, pretium justo a, pharetra justo. Vivamus quis mattis nibh, ac\n" +
        "                vehicula sem. Nam finibus nulla eros, sit amet facilisis libero gravida ut. Aliquam erat volutpat.\n" +
        "                Curabitur dignissim, dolor ut pellentesque maximus, tortor odio viverra est, sed porttitor erat diam ut\n" +
        "                tellus. Morbi volutpat nunc nec iaculis pellentesque. Proin convallis dolor vitae tortor tincidunt\n" +
        "                bibendum. Nullam nisl enim, volutpat vel vehicula et, vestibulum eget nunc.\n" +
        "            </p>";
}

function limpiar() {
    cuerpo.innerHTML = "";
    comentarios.innerHTML = "";
}

/* CREAR */

function crear() {
    cuerpo.innerHTML = "" +
        "        <div class=\"boton\" onclick='limpiar(),formvideoclub()'>\n" +
        "            <a href=\"#\"> Videoclub </a>\n" +
        "        </div>\n" +
        "\n" +
        "        <div class=\"boton\" onclick='limpiar(),formcliente()'>\n" +
        "            <a href=\"#\" > Cliente </a>\n" +
        "        </div>\n" +
        "\n" +
        "        <div class=\"boton\" onclick='limpiar(),formproducto()'>\n" +
        "            <a href=\"#\" > Producto </a>\n" +
        "        </div>";
}

function crearvideoclub() {
    let form = document.getElementById("form");
    let value = form.nombrevideoclub.value;

    if (value !== "") {
        let texto = form.nombrevideoclub.value;
        let ok = true;
        for (let i in videoclubs) {
            if (videoclubs[i].getNombre() === texto) {
                ok = false;
            }
        }
        if (ok) {
            let videoclub = new Videoclub(texto);
            videoclubs.push(videoclub);
            comentarios.innerHTML = "<h4>Correcto</h4>";
        } else {
            comentarios.innerHTML = "<h4>El nombre de ese videoclub ya existe</h4>";
        }
    } else {
        comentarios.innerHTML = "<h4>Debes introducir texto</h4>";
    }
}

function crearcliente() {
    let form = document.getElementById("form");
    let nvideoclub = form.nombrevideoclub.value;
    let ncliente = form.nombrecliente.value;

    if (nvideoclub !== "" && ncliente !== "") {

        let encontrado = false;

        for (let i in videoclubs) {
            if (videoclubs[i].getNombre() === nvideoclub) {
                encontrado = true;
                let cliente = new Cliente(ncliente);
                videoclubs[i].setCliente(cliente);
                comentarios.innerHTML = "<h4>Correcto</h4>";
            }
        }

        if (!encontrado) {
            comentarios.innerHTML = "<h4>No existe el videoclub</h4>";
        }

    } else {
        comentarios.innerHTML = "<h4>Debes introducir texto en todos los campos</h4>";
    }
}

function formvideoclub() {
    cuerpo.innerHTML = "" +
        "        <form id=\"form\">\n" +
        "            <label for=\"nombrevideoclub\">Nombre del videoclub: </label>\n" +
        "            <input type=\"text\" name=\"nombrevideoclub\" id=\"nombrevideoclub\" >\n" +
        "            <input type=\"button\" onclick=\"crearvideoclub()\" value=\"crear\">\n" +
        "        </form>";
}

function formcliente() {
    let selectoption =
        "<select name =\"nombrevideoclub\" id='nombrevideoclub'>";
    for (let i in videoclubs) {
        selectoption += "<option>" + videoclubs[i].getNombre() + "</option>";
    }
    selectoption += "</select>";

    if (videoclubs.length == 0) {
        comentarios.innerHTML = "<h4>Primero crea videoclubs</h4>";
    }

    cuerpo.innerHTML = "" +
        "        <form id=\"form\">\n" +
        "            <label for=\"nombrevideoclub\">Nombre del Videoclub: </label>\n" +
        selectoption +
        "            <label for=\"nombrecliente\">Nombre del Cliente: </label>\n" +
        "            <input type=\"text\" name=\"nombrecliente\" id=\"nombrecliente\" >\n" +
        "            <input type=\"button\" onclick=\"crearcliente()\" value=\"crear\">\n" +
        "        </form>";
}

function formproducto() {
    if (videoclubs.length == 0) {
        comentarios.innerHTML = "<h4>Primero crea videoclubs</h4>";
    }

    let selectoption =
        "<label for='nombrevideoclub'>Nombre del Videoclub</label>" +
        "<select name =\"nombrevideoclub\" id='nombrevideoclub'>";
    for (let i in videoclubs) {
        selectoption += "<option value='" + i + "'>" + videoclubs[i].getNombre() + "</option>";
    }
    selectoption += "</select>";

    cuerpo.innerHTML = "" +
        "<form id='form'>" +
        selectoption +
        "<label for='tipo'>Tipo</label>" +
        "<select name='tipo' id='tipo' onchange='cambiotipoproducto()'>" +
        "<option value='cd'>CD</option>" +
        "<option value='pelicula'>Pelicula</option>" +
        "<option value='juego'>Juego</option>" +
        "</select>" +

        "<label for='nproducto'>Nombre del producto</label>" +
        "<input type='text' name='nproducto' id='nproducto'>" +

        "<label for='cproducto'>Cantidad del producto</label>" +
        "<input type='text' name='cproducto' id='cproducto'>" +

        "<label for='i1' id='l1' >Duracion</label>" +
        "<input type='number' name='duracion' id='i1' class='tipo'>" +

        "<label for='i2' id='l2'>Genero</label>" +
        "<input type='text' name='genero' id='i2' class='tipo'>" +

        "<input type='button' class='btn btn-default' id='btnenviar' onclick='crearproducto()' value='Crear'>" +
        "</form>" +
        "";
}

function cambiotipoproducto() {
    let form = document.getElementById("form");
    form.removeChild(document.getElementById('btnenviar'));

    try {
        form.removeChild(document.getElementById("l1"));
        form.removeChild(document.getElementById("i1"));
    } catch (err) {
        console.log("He intentado borrar los elementos l1 e i1 y no existian");
    }
    try {
        form.removeChild(document.getElementById("l2"));
        form.removeChild(document.getElementById("i2"));
    } catch (err) {
        console.log("He intentado borrar los elementos l2 e i2 y no existian");
    }
    try {
        form.removeChild(document.getElementById("l3"));
        form.removeChild(document.getElementById("i3"));
    } catch (err) {
        console.log("He intentado borrar los elementos l3 e i3 y no existian");
    }

    let input1;
    let label1;
    let input2;
    let label2;
    let input3;
    let label3;

    switch (form.tipo.value) {
        case "cd":
            input1 = document.createElement("input");
            input1.setAttribute('type', 'number');
            input1.setAttribute('name', 'duracion');
            input1.setAttribute('id', 'i1');
            input1.setAttribute('class', 'tipo');

            label1 = document.createElement("label");
            label1.setAttribute("for", "duracion");
            label1.setAttribute('id', 'l1');
            label1.innerText = "Duracion";

            form.appendChild(label1);
            form.appendChild(input1);


            input2 = document.createElement("input");
            input2.setAttribute('type', 'text');
            input2.setAttribute('name', 'genero');
            input2.setAttribute('id', 'i2');

            label2 = document.createElement("label");
            label2.setAttribute("for", "genero");
            label2.innerText = "Genero";
            label2.setAttribute('id', 'l2');

            form.appendChild(label2);
            form.appendChild(input2);

            break;

        case "pelicula":
            input1 = document.createElement("input");
            input1.setAttribute('type', 'text');
            input1.setAttribute('name', 'idioma');
            input1.setAttribute('id', 'i1');

            label1 = document.createElement("label");
            label1.setAttribute("for", "idioma");
            label1.setAttribute('id', 'l1');
            label1.innerText = "Idioma";

            form.appendChild(label1);
            form.appendChild(input1);


            input2 = document.createElement("input");
            input2.setAttribute('type', 'text');
            input2.setAttribute('name', 'genero');
            input2.setAttribute('id', 'i2');

            label2 = document.createElement("label");
            label2.setAttribute("for", "genero");
            label2.innerText = "Genero";
            label2.setAttribute('id', 'l2');

            form.appendChild(label2);
            form.appendChild(input2);


            input3 = document.createElement("input");
            input3.setAttribute('type', 'number');
            input3.setAttribute('name', 'duracion');
            input3.setAttribute('id', 'i3');

            label3 = document.createElement("label");
            label3.setAttribute("for", "duracion");
            label3.innerText = "Duracion";
            label3.setAttribute('id', 'l3');

            form.appendChild(label3);
            form.appendChild(input3);
            break;

        case "juego":
            input1 = document.createElement("input");
            input1.setAttribute('type', 'text');
            input1.setAttribute('name', 'plataforma');
            input1.setAttribute('id', 'i1');


            label1 = document.createElement("label");
            label1.setAttribute("for", "plataforma");
            label1.setAttribute('id', 'l1');
            label1.innerText = "Plataforma";

            form.appendChild(label1);
            form.appendChild(input1);


            input2 = document.createElement("input");
            input2.setAttribute('type', 'text');
            input2.setAttribute('name', 'genero');
            input2.setAttribute('id', 'i2');

            label2 = document.createElement("label");
            label2.setAttribute("for", "genero");
            label2.innerText = "Genero";
            label2.setAttribute('id', 'l2');

            form.appendChild(label2);
            form.appendChild(input2);
            break;
    }

    let button = document.createElement("input");
    button.setAttribute('type', 'button');
    button.setAttribute('id', 'btnenviar');
    button.setAttribute('onclick', 'crearproducto()');
    button.setAttribute('value', 'Crear');
    form.appendChild(button);
}

function crearproducto() {
    let form = document.getElementById("form");
    let nvideoclub = document.getElementById("nombrevideoclub").value;
    let nombre = form.nproducto.value;
    let cproducto = form.cproducto.value;
    let duracion = "";
    let precio = "";
    let genero = "";
    let idioma = "";
    let plataforma = "";
    let vacio = false;
    if (esnumero(cproducto)) {
        if (videoclubs[nvideoclub].getProducto(nombre) === false) {
            switch (form.tipo.value) {
                case "cd":
                    genero = form.genero.value;
                    duracion = form.duracion.value;
                    if (nombre != "" && genero != "" && duracion != "") {
                        let cd = new CD(nombre);
                        cd.setGenero(genero);
                        cd.setCantidad(cproducto);
                        cd.setDuracion(duracion);
                        videoclubs[nvideoclub].setProducto(cd);
                    } else {
                        vacio = true;
                    }
                    break;

                case "pelicula":
                    idioma = form.idioma.value
                    genero = form.genero.value
                    duracion = form.duracion.value;
                    if (nombre != "" && idioma != "" && genero != "" && duracion != "") {
                        let pelicula = new Pelicula(nombre, idioma, genero, duracion);
                        pelicula.setCantidad(cproducto);
                        videoclubs[nvideoclub].setProducto(pelicula);
                    } else {
                        vacio = true;
                    }


                    break;

                case "juego":
                    plataforma = form.plataforma.value;
                    genero = form.genero.value;
                    if (nombre != "" && plataforma != "" && genero != "") {
                        let juego = new Juego(nombre, plataforma, genero);
                        juego.setCantidad(cproducto);
                        videoclubs[nvideoclub].setProducto(juego);
                    } else {
                        vacio = true;
                    }

                    break;
            }

            if (vacio) {
                comentarios.innerHTML = "<h4>Debes introducir texto en todos los campos</h4>";
            } else {
                comentarios.innerHTML = "<h4>Correcto</h4>";
            }

        } else {
            comentarios.innerHTML = "<h4>Ya existe un producto con ese nombre</h4>";
        }

    } else {
        comentarios.innerHTML = "<h4>Cantidad debe ser un numero</h4>";
    }
}

/* ELIMINAR */

function eliminar(idproducto, idvideoclub) {
    limpiar();
    usar();
    let productos = videoclubs[idvideoclub].getProductos();
    for (let i in productos) {
        if (i == idproducto) {
            productos.splice(i, 1);
            comentarios.innerHTML = "eliminado";
        }
    }
}

function eliminarcliente(idcliente, idvideoclub) {
    limpiar();
    usar();
    let clientes = videoclubs[idvideoclub].getClientes();
    for (let i in clientes) {
        if (i == idcliente) {
            clientes.splice(i, 1);
            comentarios.innerHTML = "eliminado";
        }
    }

}

function eliminarvideoclub(idvideoclub) {
    limpiar();
    usar();
    for (let i in videoclubs) {
        if (i == idvideoclub) {
            videoclubs.splice(i, 1);
            comentarios.innerHTML = "eliminado";
        }
    }
}

/* USAR */

function usar() {
    cuerpo.innerHTML = "" +
        "        <div class=\"boton\" onclick='limpiar(),vervideoclubs(\"verClientes()\")'>" +
        "            <a href=\"#\"> Ver Videoclubs </a>\n" +
        "        </div>" +

        "        <div class=\"boton\" onclick='limpiar(),selecVideoclub(\"verClientes()\")'>" +
        "            <a href=\"#\"> Ver Clientes </a>\n" +
        "        </div>" +

        "        <div class=\"boton\" onclick='limpiar(),selecVideoclub(\"verProductos()\")'>" +
        "            <a href=\"#\"> Ver Productos </a>\n" +
        "        </div>" +

        "        <div class=\"boton\" onclick='limpiar(),selecVideoclub(\"verproductosalquilados()\")'>" +
        "            <a href=\"#\"> Ver Productos Alquilados </a>\n" +
        "        </div>" +

        "        <div class=\"boton\" onclick='limpiar(),selecVideoclub(\"listadodeproductossindevolver()\")'>" +
        "            <a href=\"#\"> Ver Productos pendientes de Devolucion </a>\n" +
        "        </div>" +

        "        <div class=\"boton\" onclick='limpiar(),selecVideoclub(\"verfechadevoluciondelosproductos()\")'>" +
        "            <a href=\"#\"> Ver Fechas de Devolucion </a>\n" +
        "        </div>";
}

function vervideoclubs() {
    let tabla = "<table>";
    tabla += "<tr><th>Nombre</th><th>Clientes</th><th>Productos</th><th>Acciones</th></tr>";
    for (let i in videoclubs) {
        tabla += "<tr><td>" + videoclubs[i].getNombre() + "</td><td>" + videoclubs[i].getClientes().length + "</td><td>" + videoclubs[i].getProductos().length + "</td><td><input type='button' class='btn btn-danger' value='ELIMINAR' onclick='eliminarvideoclub(" + i + ")'></td></>";
    }
    tabla+="</table>";
    cuerpo.innerHTML=tabla;
}

function selecVideoclub(action) {
    if (videoclubs.length == 0) {
        comentarios.innerHTML = "<h4>Primero crea videoclubs</h4>";
    }

    let selectoption =
        "<form id='form'>" +
        "<label for='nombrevideoclub'>Nombre del Videoclub</label>" +
        "<select name =\"nombrevideoclub\" id='nombrevideoclub'>";

    for (let i in videoclubs) {
        selectoption += "<option value='" + i + "'>" + videoclubs[i].getNombre() + "</option>";
    }

    selectoption += "</select>" +
        "<input type='button' class='btn btn-default' value='Seleccionar' onclick='" + action + "'>" +
        "</form>";

    cuerpo.innerHTML = selectoption;
}

function verClientes() {
    let form = document.getElementById("form");
    let idvideoclub = form.nombrevideoclub.value;
    if (idvideoclub != "") {
        let tabla = "<table class=\"table table-striped\">";
        tabla += "<tr class='t0'><th>Cliente</th><th>Numero</th><th>Acciones</th></tr>";
        let clientes = videoclubs[idvideoclub].getClientes();

        for (let i in clientes) {
            tabla += "<tr><td>" + clientes[i].getNombre() + "</td><td>" + i + "</td><td><input type='button' class='btn btn-danger' value='ELIMINAR' onclick='eliminarcliente(" + i + "," + idvideoclub + ")'><input type='button' class='btn btn-default' value='Alquilar' onclick='selectobjetoalquilar(" + i + "," + idvideoclub + ")'>  <input type='button' class='btn btn-default' value='Devolver' onclick='selectobjetodevolver(" + i + "," + idvideoclub + ")'></td></tr>";
        }

        tabla += "</table>";
        cuerpo.innerHTML = tabla;
    }
}

function cambioEnSelectVerProductos(idvideoclub) {
    let form = document.getElementById("form");
    let tipo = document.getElementById("selectverproducto");
    tipo = tipo.value;

    selectverproducto(idvideoclub);
    cuerpo.innerHTML += "<p>--" + tipo + "--</p>";

    let tabla = "<table class=\"table table-striped\">";
    tabla += "<tr class='t0'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Ultimo Alquiler</th></tr>";
    let productos = videoclubs[idvideoclub].getProductos();


    switch (tipo) {
        case "CD":
            for (let i in productos) {
                if (productos[i] instanceof CD) {
                    tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td></tr>";
                }
            }
            break;

        case "Pelicula":
            for (let i in productos) {
                if (productos[i] instanceof Pelicula) {
                    tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td></tr>";

                }
            }
            break;

        case "Juego":
            for (let i in productos) {
                if (productos[i] instanceof Juego) {
                    tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td></tr>";

                }
            }
            break;

        case "Todos":
            for (let i in productos) {
                if (productos[i] instanceof Object) {
                    tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td></tr>";

                }
            }
            break;

    }
    tabla += "</table>";
    cuerpo.innerHTML += tabla;
}

function selectverproducto(idvideoclub) {
    cuerpo.innerHTML =
        "<select id='selectverproducto' onchange='cambioEnSelectVerProductos(" + idvideoclub + ")'>" +
        "<option value=''>Selecciona Una Opcion</option>" +
        "<option value='Todos'>Todos</option>" +
        "<option value='Pelicula'>Peliculas</option>" +
        "<option value='CD'>CDs</option>" +
        "<option value='Juego'>Juegos</option>" +
        "</select>";
}

function verProductos() {
    let form = document.getElementById("form");
    let idvideoclub = form.nombrevideoclub.value;
    if (idvideoclub != "") {
        limpiar();
        selectverproducto(idvideoclub);
        let tabla = "<table class=\"table table-striped\">";
        tabla += "<tr class='t0'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Ultimo Alquiler</th><th>Acciones</th></tr>";
        let productos = videoclubs[idvideoclub].getProductos();
        for (let i in productos) {
            var libre = true;
            let estados = productos[i].getEstados();

            for (let c in estados) {
                if (estados[c] != "libre") {
                    libre = false;
                }
            }
            if (libre) {
                tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td><td><input type='button' class='btn btn-danger' value='Eliminar' onclick='eliminar(" + i + "," + idvideoclub + ")'></td></tr>";
            } else {
                tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td><td></td></tr>";
            }
        }

        tabla += "</table>";
        cuerpo.innerHTML += tabla;
    }
}

function selectobjetoalquilar(idcliente, idvideoclub) {
    let form = document.getElementById("form");
    limpiar();

    let select = "<select id='selectobjetoalquilar'>";

    let productos = videoclubs[idvideoclub].getProductos();

    for (let i in productos) {
        let cproducto = productos[i].getCantidad();

        let libre = false;

        for (let c = 0; c < cproducto && libre == false; c++) {

            let eproducto = productos[i].getEstado(c);
            if (eproducto == "libre") {
                libre = true;
                cuerpo.innerHTML += "<input type='hidden' id='posiciondelproducto' value='" + c + "'>";
            }

            if (libre) {

                select += "<option>" + productos[i].getNombre() + "</option>";

            }
        }
    }
    select += "</select>";
    cuerpo.innerHTML += select;
    cuerpo.innerHTML += "<input type='button' class='btn btn-default' value='Alquilar' onclick='alquilar(" + idcliente + "," + idvideoclub + ")'>";
}

function alquilar(idcliente, idvideoclub) {
    let form = document.getElementById("form");
    let nproducto = document.getElementById("selectobjetoalquilar").value;
    let posiciondelproducto = document.getElementById("posiciondelproducto").value;
    limpiar();

    let cliente = videoclubs[idvideoclub].getClientes();
    cliente = cliente[idcliente];

    let producto = videoclubs[idvideoclub].getProducto(nproducto);
    producto.setEstado(posiciondelproducto, "alquilado");
    producto.Alquilar(fechaActual());

    videoclubs[idvideoclub].nuevoAlquilerVideoclub(producto, cliente);
    cuerpo.innerHTML = "Alquilado Correctamente";
}

function selectobjetodevolver(idcliente, idvideoclub) {
    let form = document.getElementById("form");
    limpiar();

    let select = "<select id='selectobjetodevolver'>";
    let cliente = videoclubs[idvideoclub].getClientes()[idcliente];

    let productos = cliente.getProductos();

    for (let i in productos) {
        let cproducto = productos[i].getCantidad();

        let libre = false;

        for (let c = 0; c < cproducto && libre == false; c++) {

            let eproducto = productos[i].getEstado(c);
            if (eproducto == "alquilado") {
                libre = true;
                cuerpo.innerHTML += "<input type='hidden' id='posiciondelproducto' value='" + c + "'>";
            }

            if (libre) {

                select += "<option>" + productos[i].getNombre() + "</option>";

            }
        }
    }
    select += "</select>";
    cuerpo.innerHTML += select;
    cuerpo.innerHTML += "<input type='button' class='btn btn-default' value='Devolver' onclick='devolver(" + idcliente + "," + idvideoclub + ")'>";
}

function devolver(idcliente, idvideoclub) {
    let form = document.getElementById("form");
    let nproducto = document.getElementById("selectobjetodevolver").value;
    let posiciondelproducto = document.getElementById("posiciondelproducto").value;
    if (posiciondelproducto) {
        limpiar();

        let cliente = videoclubs[idvideoclub].getClientes();
        cliente = cliente[idcliente];

        let producto = videoclubs[idvideoclub].getProducto(nproducto);
        producto.setEstado(posiciondelproducto, "libre");

        cliente.devolver(producto);
        producto.nuevaDevolucion(fechaActual());
        cuerpo.innerHTML = "Devuelto Correctamente";
    }
}

function listadodeproductossindevolver() {
    let form = document.getElementById("form");
    let idvideoclub = form.nombrevideoclub.value;
    if (idvideoclub != "") {
        limpiar();

        let tabla = "<table class=\"table table-striped\">";
        tabla += "<tr class='t0'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Ultimo Alquiler</th></tr>";
        let productos = videoclubs[idvideoclub].getProductos();
        for (let i in productos) {
            if (productos[i].contaralquilados() >= 1) {
                tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getUltimoAlquiler()) + "</td></tr>";
            }
        }

        tabla += "</table>";
        cuerpo.innerHTML += tabla;
    }
}

function verproductosalquilados() {
    let form = document.getElementById("form");
    let idvideoclub = form.nombrevideoclub.value;
    if (idvideoclub != "") {
        limpiar();

        let tabla = "<table class=\"table table-striped\">";
        tabla += "<tr class='t0'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Alquileres</th></tr>";
        let productos = videoclubs[idvideoclub].getProductos();
        for (let i in productos) {
            for (let c in productos[i].getAlquileres()) {
                tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getAlquiler(c)) + "</td></tr>";
            }
        }

        tabla += "</table>";
        cuerpo.innerHTML += tabla;
        selectentrefechas(idvideoclub);
    }
}

function fechaActual() {
    let f = new Date();
    let fecha = "";
    return ("" + f.getFullYear() + (f.getMonth() + 1) + f.getDate());
}

function fechaformateada(fechasinnada) {
    let year = "";
    let mes = "";
    let dia = "";
    if (fechasinnada == undefined) {
        return "NUNCA";
    }
    for (let c = 0; c < fechasinnada.length; c++) {

        if (c < 4) {
            year += fechasinnada[c];
        } else if (c < 6) {
            mes += fechasinnada[c];
        } else {
            dia += fechasinnada[c];
        }
    }
    return (year + "/" + (mes) + "/" + dia);
}

function selectentrefechas(idvideoclub) {

    let f = "<form id='form'>";

    f += "<span>Entre: </span><input name='f1' type='date'>";
    f += "<span> Y </span><input name='f2' type='date'>";
    f += "<div><input type='button' class='btn btn-default' onclick='filtrarfechasproductosalquilados(" + idvideoclub + ")' value='Filtrar'> </div>";
    f += "</form>";
    cuerpo.innerHTML += "<div>" + f + "</div>";
}

function verfechadevoluciondelosproductos() {
    let form = document.getElementById("form");
    let idvideoclub = form.nombrevideoclub.value;
    if (idvideoclub != "") {
        limpiar();

        let tabla = "<table class=\"table table-striped\">";
        tabla += "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Devoluciones</th></tr>";
        let productos = videoclubs[idvideoclub].getProductos();
        for (let i in productos) {
            for (let c in productos[i].getDevoluciones()) {
                tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getDevolucion(c)) + "</td></tr>";
            }
        }

        tabla += "</table>";
        cuerpo.innerHTML += tabla;
    }
    selectentrefechasdevueltos(idvideoclub);
}

function selectentrefechasdevueltos(idvideoclub) {

    let f = "<form id='form'>";
    f += "<span>Entre: </span><input name='f1' type='date'>";
    f += "<span> Y </span><input name='f2' type='date'>";
    f += "<div><input type='button' class='btn btn-default' onclick='filtrarfechasproductosdevueltos(" + idvideoclub + ")' value='Filtrar'> </div>";
    f += "</form>";
    cuerpo.innerHTML += "<div>" + f + "</div>";
}

function filtrarfechasproductosdevueltos(idvideoclub) {
    let form = document.getElementById("form");

    let f1 = form.f1.value;
    f1 = reemplazar(f1, "-", "");
    f1 = arraydefecha(f1);

    let f2 = form.f2.value;
    f2 = reemplazar(f2, "-", "");
    f2 = arraydefecha(f2);

    limpiar();

    let tabla = "<table class=\"table table-striped\">";
    tabla += "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Devoluciones</th></tr>";
    let productos = videoclubs[idvideoclub].getProductos();
    for (let i in productos) {
        for (let c in productos[i].getDevoluciones()) {
            let fecha = arraydefecha(productos[i].getAlquiler(c));
            if (f1["year"] <= fecha["year"] && f2["year"] >= fecha["year"]) {
                if (f1["mes"] <= fecha["mes"] && f2["mes"] >= fecha["mes"]) {
                    if (f1["dia"] <= fecha["dia"] && f2["dia"] >= fecha["dia"]) {
                        tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getDevolucion(c)) + "</td></tr>";
                    }
                }
            }
        }
    }

    tabla += "</table>";
    cuerpo.innerHTML += tabla;

    selectentrefechasdevueltos(idvideoclub);
}

function filtrarfechasproductosalquilados(idvideoclub) {
    let form = document.getElementById("form");

    let f1 = form.f1.value;
    f1 = reemplazar(f1, "-", "");
    f1 = arraydefecha(f1);

    let f2 = form.f2.value;
    f2 = reemplazar(f2, "-", "");
    f2 = arraydefecha(f2);

    limpiar();

    let tabla = "<table class=\"table table-striped\">";
    tabla += "<tr class='t0'><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Alquilados</th><th>Libres</th><th>Alquileres</th></tr>";
    let productos = videoclubs[idvideoclub].getProductos();
    for (let i in productos) {
        for (let c in productos[i].getAlquileres()) {
            let fecha = arraydefecha(productos[i].getAlquiler(c));
            if (f1["year"] <= fecha["year"] && f2["year"] >= fecha["year"]) {
                if (f1["mes"] <= fecha["mes"] && f2["mes"] >= fecha["mes"]) {
                    if (f1["dia"] <= fecha["dia"] && f2["dia"] >= fecha["dia"]) {
                        tabla += "<tr><td>" + productos[i].getNombre() + "</td><td>" + productos[i].getPrecio() + "</td><td>" + productos[i].getCantidad() + "</td><td>" + productos[i].contaralquilados() + "</td><td>" + productos[i].contarlibres() + "</td><td>" + fechaformateada(productos[i].getAlquiler(c)) + "</td></tr>";
                    }
                }
            }
        }
    }

    tabla += "</table>";
    cuerpo.innerHTML += tabla;
    selectentrefechas(idvideoclub);


}

function arraydefecha(fechasinnada) {
    let year = "";
    let mes = "";
    let dia = "";
    if (fechasinnada == undefined) {
        return "NUNCA";
    }
    for (let c = 0; c < fechasinnada.length; c++) {
        if (fechasinnada[c] != "/") {
            if (c < 4) {
                year += fechasinnada[c];
            } else if (c < 6) {
                mes += fechasinnada[c];
            } else {
                dia += fechasinnada[c];
            }
        }
    }
    let array = [];
    array["year"] = year;
    array["mes"] = mes;
    array["dia"] = dia;
    return array;
}

