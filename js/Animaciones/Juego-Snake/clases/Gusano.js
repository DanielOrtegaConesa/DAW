class Gusano {
    constructor() {
        this.piezas = new Array();
    }

    setPiezas(piezas) {
        this.piezas = piezas;
    }

    nuevaPieza(pieza) {
        this.piezas.push(pieza);
    }

    getPiezas() {
        return this.piezas;
    }

    /*
    *  En un orden de piezas 0 1 2 3 4 5
    *  La pieza 0 guarda su posicion y se mueve (size)
    *  La pieza 1 guarda su posicion, recoge y se asigna la posicion que ha guardado la pieza 0
    *  La pieza 2 guarda su posicion, recoge y se asigna la posicion que ha guardado la pieza 1
    *  La pieza 3 g....
    * */
    mover(dirX,dirY) {
        for (let i in gusano.piezas) {
            if (i == 0) {

                let cabeza = gusano.piezas[0];
                let cabezaX = cabeza.getPosicionX();
                let cabezaY = cabeza.getPosicionY();

                //guardamos su posicion antes de mover
                cabeza.anteriorPosicionX = cabezaX;
                cabeza.anteriorPosicionY = cabezaY;

                //movemos
                cabeza.setPosicionX(cabezaX + dirX);
                cabeza.setPosicionY(cabezaY + dirY);

            } else {
                let actual = gusano.piezas[i];//la pieza del gusano sobre la que actuamos
                let piezanterior = gusano.piezas[i - 1];//la pieza que se mueve antes que la actual

                let anteriorX = piezanterior.getAnteriorX();//la posicionX que tenia la pieza anterior antes de moverse
                let anteriorY = piezanterior.getAnteriorY();//la posicionY que tenia la pieza anterior antes de moverse

                actual.setAnteriorX(actual.getPosicionX());//guardamos la posicionX de la pieza actual antes de moverlo para que el que le sigue sepa donde ponerse
                actual.setAnteriorY(actual.getPosicionY());//guardamos la posicionY de la pieza actal antes de moverlo para que el que le sigue sepa donde ponerse

                actual.setPosicionX(anteriorX);//le cambiamos la posicion por la que tenia su anterior antes de moverse
                actual.setPosicionY(anteriorY);//le cambiamos la posicion por la que tenia su anterior antes de moverse
            }
        }
    }
    dibujar(ctx,size) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);//borra todo el canvas
        for (let i in this.piezas) {
            if (i == 0) {
                ctx.fillStyle = "black";
            } else {
                ctx.fillStyle = "#005577";
            }
            let x = this.piezas[i].getPosicionX();
            let y = this.piezas[i].getPosicionY();
            ctx.fillRect(x, y, size, size);
        }
    }
}