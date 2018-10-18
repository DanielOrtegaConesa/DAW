<?php

class Usuario
{

    private $codCliente = "";
    private $dni = "";
    private $razonSocial = "";
    private $domicilioSocial = "";
    private $ciudad = "";
    private $email = "";
    private $telefono = "";
    private $nick = "";
    private $pass = "";
    private $activo = "";
    private $img = "";

    private $tipo = "";
    private $articulos = [];

    public function __construct($nick, $pass = "")
    {
        $this->nick = $nick;
        $this->pass = $pass;
    }

    public function __toString()
    {
        return "Has seleccioando a $this->nick, miembro de $this->razonSocial";
    }

    public function __clone()
    {
        foreach ($this->articulos as $indice => $articulo) {
            $this->articulos[$indice] = clone($articulo);
        }
    }

    public function nuevoArticulo($conexion, $codArt)
    {
        if (!isset($this->articulos[$codArt])) {
            $this->articulos[$codArt] = new Articulo($codArt);
            $this->articulos[$codArt]->cargar($conexion);
            return true;
        } else {
            $this->articulos[$codArt]->aumentarCantidad();
            return true;
        }
        return false;
    }

    public function eliminarArticulo($codArt)
    {
        if (isset($this->articulos[$codArt])) {
            unset($this->articulos[$codArt]);
        }
    }
    public function eliminarArticulos()
    {
        $this->articulos = [];
    }

    public function cargar($conexion)
    {
        $adatos = arrayDatosPDO("nick", "$this->nick");
        $res = selectPrepPDO($conexion, "*", "clientes", $adatos);
        $res = $res[0];
        $this->setCodCliente($res["codCliente"]);
        $this->setDni($res["dni"]);
        $this->setRazonSocial($res["razonSocial"]);
        $this->setDomicilioSocial($res["domicilioSocial"]);
        $this->setCiudad($res["ciudad"]);
        $this->setEmail($res["email"]);
        $this->setTelefono($res["telefono"]);
        $this->setActivo($res["activo"]);
        $this->setImg($res["img"]);
    }

    public function getArticulo($id){
        return $this->articulos[$id];
    }





    /* Getters and Setters */
    /**
     * @return string
     */
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * @param string $codCliente
     */
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;
    }

    /**
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * @param string $razonSocial
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
    }

    /**
     * @return string
     */
    public function getDomicilioSocial()
    {
        return $this->domicilioSocial;
    }

    /**
     * @param string $domicilioSocial
     */
    public function setDomicilioSocial($domicilioSocial)
    {
        $this->domicilioSocial = $domicilioSocial;
    }

    /**
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param string $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param string $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param string $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return array
     */
    public function getArticulos()
    {
        return $this->articulos;
    }

    /**
     * @param array $articulos
     */
    public function setArticulos($articulos)
    {
        $this->articulos = $articulos;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }


}