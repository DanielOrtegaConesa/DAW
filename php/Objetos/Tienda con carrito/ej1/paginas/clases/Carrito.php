<?php

class Carrito
{
    private $piezas;

    public  function vaciar(){
        $this->piezas=[];
    }
    public function getPiezas()
    {
        return $this->piezas;
    }
    public function  getPieza($NUMPIEZA)
    {
        if(isset($this->piezas[$NUMPIEZA])) {
            return $this->piezas[$NUMPIEZA];
        }else{
            return false;
        }
    }

    /* Metodos Propios */
    public function addPieza($pieza)
    {
        if ($pieza instanceof Pieza) {
            if (!isset($this->piezas[$pieza->getNUMPIEZA()])) {
                $this->piezas[$pieza->getNUMPIEZA()] = $pieza;

            } else {
                $this->piezas[$pieza->getNUMPIEZA()]->aumentarCantidad();
            }
            return true;
        }
        return false;
    }

    public function delPieza($NUMPIEZA)
    {
        unset($this->piezas[$NUMPIEZA]);
    }

    /* Metodos Magicos */
    public function __construct()
    {
        $this->piezas = [];
    }

    public function __toString()
    {
        $texto = "<pre>";
        foreach ($this->piezas as $indice => $pieza) {
            $texto .= "$pieza<br/>";
        }
        $texto .= "</pre>";
        return $texto;
    }

    public function __clone()
    {
        foreach ($this->piezas as $indice => $pieza) {
            $this->piezas[$indice] = clone($pieza);
        }
    }
}