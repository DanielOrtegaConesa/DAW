<?php

class Articulo
{

    private $codArticulo;
    private $img;
    private $nombre;
    private $descripcion;
    private $precio;
    private $descuento;
    private $iva;

    private $cantidad = 1;

    public function __construct($codArticulo)
    {
        $this->codArticulo = $codArticulo;
    }

    public function __toString()
    {
        return "El codigo de este articulo es: " . $this->codArticulo;
    }

    public function cargar($conexion)
    {
        $adatos = arrayDatosPDO("codArticulo", "$this->codArticulo");
        $res = selectPrepPDO($conexion, "*", "articulos", $adatos);
        $res = $res[0];

        $this->setImg($res["img"]);
        $this->setNombre($res["nombre"]);
        $this->setDescripcion($res["descripcion"]);
        $this->setPrecio($res["precio"]);
        $this->setDescuento($res["descuento"]);
        $this->setIva($res["iva"]);
    }

    public function aumentarCantidad()
    {
        $this->cantidad += 1;
    }

    /* GET / SET */

    /**
     * @return mixed
     */
    public function getCodArticulo()
    {
        return $this->codArticulo;
    }

    /**
     * @param mixed $codArticulo
     */
    public function setCodArticulo($codArticulo)
    {
        $this->codArticulo = $codArticulo;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * @return mixed
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param mixed $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }


}