<?php

class Pieza
{

    private $NUMPIEZA;
    private $NOMPIEZA;
    private $PRECIOVENT;
    private $RUTAIMG;

    private $cantidad=1;

    /* Set y Get */

    public function getNUMPIEZA()
    {
        return $this->NUMPIEZA;
    }

    public function setNUMPIEZA($NUMPIEZA)
    {
        $this->NUMPIEZA = $NUMPIEZA;
    }

    public function getNOMPIEZA()
    {
        return $this->NOMPIEZA;
    }

    public function setNOMPIEZA($NOMPIEZA)
    {
        $this->NOMPIEZA = $NOMPIEZA;
    }

    public function getPRECIOVENT()
    {
        return $this->PRECIOVENT;
    }

    public function setPRECIOVENT($PRECIOVENT)
    {
        $this->PRECIOVENT = $PRECIOVENT;
    }

    public function getRUTAIMG()
    {
        return $this->RUTAIMG;
    }

    public function setRUTAIMG($RUTAIMG)
    {
        $this->RUTAIMG = $RUTAIMG;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /* Metodos Propios */
    public function aumentarCantidad(){
        $this->cantidad++;
    }

    /* Metodos Magicos */
    public function __construct($NUMPIEZA, $NOMPIEZA = "", $PRECIOVENT = "")
    {
        $this->NUMPIEZA = $NUMPIEZA;
        $this->NOMPIEZA = $NOMPIEZA;
        $this->PRECIOVENT = $PRECIOVENT;
    }

    public function __toString()
    {
        return "Numero: $this->NUMPIEZA - Nombre: $this->NOMPIEZA - Precio: $this->PRECIOVENT - Cantidad: $this->cantidad";
    }
}