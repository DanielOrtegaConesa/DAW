/*
* Algunos fragmentos de codigo estan documentados para facilitar la comprension,
* Si un fragmento esta documentado, su documentacion esta SIEMPRE encima o AL LADO,
* de modo que NUNCA estara por debajo.
*
* Comento esto por si hay dudas de a que fragmento pertenece alguna documentacion
* */

"use strict";
var size = 5;// tamaño por cada parte del gusano
var velocidad = 100; // Cuanto mas alto sea el numero mas lento ira
var piezasgusano = 10; //cantidad de piezas del size asignado que tendra el gusano

var dirX = -size;//Direccion HORIZONTAL //positivo = derecha, negativo = izquierda
var dirY = 0;//Direccion VERTICAL //positivo = abajo, negativo = arriba

//Estas dos se utilzan para que no se pueda dar la vuelta sobre si mismo
// de modo que si se esta usando el eje X solo se pueda usar el Y (metodo direccion() )
var ejex = true;
var ejey = false;

var empezado =false;
var chocado = false;
var dicho = false; // indica si se ha realizado un alert diciendo que te has chocado, esto es para que solo lo diga una vez
var mensajedealerta = "Te has chocado";//mensaje que dira el alert

var ciclico = false; // si es o no ciclico


var contador = 0;
var gusano = new Gusano();
var minas = new Array();

var piezas = new Array();
for (let c = 130, veces = 0; veces < piezasgusano; c += size, veces++) {
    var pieza = new Piezagusano(c, 50);
    piezas.push(pieza);
}
gusano.setPiezas(piezas);

function empezar() {
    if(chocado==true){
        location.href = "pagina.html"
    }
    minas=[];
    for (let c = 0; c < document.opciones.minas.value; c++) {
        let mina = new Mina(aleatorio(0, 400), aleatorio(0, 300));
        minas.push(mina);
    }
    if(!empezado) {
        setInterval("main()", velocidad);
        empezado=true;
    }
}

//setInterval("main()", velocidad);

////////////////////////////////
function aleatorio(minincl, maxincl) {
    var numero = 1;
    do {
        numero = (Math.random() * (maxincl - minincl) + minincl).toFixed();
    } while ((numero % 5) !== (0));

    return numero;
}

////////////////////////////////
function main() {
    if (chocado == false) {
        comprobarChocado();
        if (chocado == false) {
            dibujar();
            contador++;
            renovarpuntuacion();
            movimiento();
        }
        if (chocado && dicho == false) {
            alert(mensajedealerta);
            dicho = true;
        }
    }
    if (contador % 5 == 0) {
        let piezas = gusano.getPiezas();
        let pieza = new Piezagusano(piezas[piezas.length - 1].getAnteriorX(), piezas[piezas.length - 1].getAnteriorY());
        gusano.nuevaPieza(pieza);
        piezasgusano++;//solamente como referencia para saber la cantidad
    }
}

////////////////////////////////

////////////////////////////////
function comprobarChocado() {
    //con el tablero
    if (!ciclico) {
        if (gusano.piezas[0].getPosicionX() == canvas.width || gusano.piezas[0].getPosicionY() == canvas.height) {
            chocado = true;
        }
        if (gusano.piezas[0].getPosicionX() < 0 || gusano.piezas[0].getPosicionY() < 0) {
            chocado = true;
        }
    } else {
        if (gusano.piezas[0].getPosicionX() == canvas.width) {
            gusano.piezas[0].setPosicionX(0);
        }
        if (gusano.piezas[0].getPosicionY() == canvas.height) {
            gusano.piezas[0].setPosicionY(0);
        }
        if (gusano.piezas[0].getPosicionX() < 0) {
            gusano.piezas[0].setPosicionX(canvas.width);
        }
        if (gusano.piezas[0].getPosicionY() < 0) {
            gusano.piezas[0].setPosicionY(canvas.height);
        }
    }

    // con si mismo
    let piezas = gusano.getPiezas();
    let cabeza = piezas[0];
    for (let i in piezas) {
        if (Number(i) !== 0) {
            console.log("I: " + i + " X: " + piezas[i].getPosicionX() + " " + cabeza.getPosicionX() + " Y: " + piezas[i].getPosicionY() + " " + cabeza.getPosicionY());
            if ((piezas[i].getPosicionX() === cabeza.getPosicionX()) && (piezas[i].getPosicionY() === cabeza.getPosicionY()) && piezasgusano != 10) {
                chocado = true;
            }
        }
    }

    //con una mina
    for (let i in minas) {

        let minaX = minas[i].getPosicionX() * 1;
        let cabezaX = cabeza.getPosicionX() * 1;

        let minaY = minas[i].getPosicionY() * 1;
        let cabezaY = cabeza.getPosicionY() * 1;

        console.log("MinaX: " + minaX + " | CabezaX: " + cabezaX);
        console.log("MinaY: " + minaY + " | CabezaY: " + cabezaY);

        console.log(((minaX === cabezaX) && (minaY === cabezaY)));
        console.log((((minaX + 5) === cabezaX) && (minaY === cabezaY)));
        console.log(((minaX === cabezaX) && ((minaY + 5) === cabezaY)));
        console.log((((minaX + 5) === cabezaX) && ((minaY + 5) === cabezaY)));

        if ((minaX === cabezaX) && (minaY === cabezaY)) {
            chocado = true;
        }

        if (((minaX + 5) === cabezaX) && (minaY === cabezaY)) {
            chocado = true;
        }

        if ((minaX === cabezaX) && ((minaY + 5) === cabezaY)) {
            chocado = true;
        }

        if (((minaX + 5) === cabezaX) && ((minaY + 5) === cabezaY)) {
            chocado = true;
        }
    }
}

////////////////////////////////

////////////////////////////////
function movimiento() {
    gusano.mover(dirX, dirY);
}

////////////////////////////////

////////////////////////////////
function dibujar() {
    var canvas = document.getElementById("canvas");

    canvas.width = 400;
    canvas.height = 300;

    var ctx = canvas.getContext("2d");
    //gusano
    gusano.dibujar(ctx, size);

    //minas
    for (let i in minas) {

        ctx.fillStyle = "black";
        let x = minas[i].getPosicionX();
        let y = minas[i].getPosicionY();
        ctx.fillRect(x, y, 10, 10);
    }

}

////////////////////////////////

////////////////////////////////
function direccion(event) {
    /*
    RECORDATORIO
    dirX //Direccion HORIZONTAL en la que ira el gusano //positivo = derecha, negativo = izquierda
    dirY //Direccion VERTICAL //positivo = abajo, negativo = arriba
    */
    var cod = event.keyCode;
    if (ejex) {
        switch (cod) {
            case 38://arriba
                dirX = 0;
                dirY = -size;
                ejex = false;
                ejey = true;
                break;
            case 40://abajo
                dirX = 0;
                dirY = size;
                ejex = false;
                ejey = true;
                break;
        }
    }
    if (ejey) {
        switch (cod) {
            case 39://derecha
                dirX = size;
                dirY = 0;
                ejey = false;
                ejex = true;
                break;
            case 37://izquierda
                dirX = -size;
                dirY = 0;
                ejey = false;
                ejex = true;
                break;
        }
    }
}

////////////////////////////////

////////////////////////////////
function changeciclico() {
    if (document.opciones.ciclico.value == "si") {
        ciclico = true;
    } else {
        ciclico = false;
    }
}

function changerango() {
    document.getElementById("valorrange").innerHTML = "<p>" + document.opciones.minas.value + "</p>";
}
function renovarpuntuacion() {


    var sal= "000000" + contador;
    sal = sal.substring(sal.length-6);

    document.getElementById("puntuacion").innerHTML = "<p>" + sal + "</p>";

}
////////////////////////////////
