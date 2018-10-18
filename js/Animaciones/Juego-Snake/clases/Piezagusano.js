
class Piezagusano {
    constructor(x, y) {
        this.posicionX = x;
        this.posicionY = y;

        // Antes de moverse, cada pieza almacenara donde estaba, de modo que la que le sigue se pondra en esta posicion
        this.anteriorPosicionX = x;
        this.anteriorPosicionY = y;
    }

    setPosicionX(x) {
        this.posicionX = x;
    }

    setPosicionY(y) {
        this.posicionY = y;
    }

    getPosicionX() {
        return this.posicionX;
    }

    getPosicionY() {
        return this.posicionY;
    }

    setAnteriorX(x) {
        this.anteriorPosicionX = x;
    }

    setAnteriorY(y) {
        this.anteriorPosicionY = y;
    }

    getAnteriorX() {
        return this.anteriorPosicionX;
    }

    getAnteriorY() {
        return this.anteriorPosicionY;
    }
}