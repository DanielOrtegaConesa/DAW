<?php

class UsuarioGestion
{
    private $codUsuarioGestion = "";
    private $nombre = "";
    private $nick = "";
    private $pass = "";

    private $tipo = "";

    public function __construct($nick, $pass)
    {
        $this->pass = $pass;
        $this->nick = $nick;
    }

    public function __toString()
    {
        return "Este usuario se llama $this->nick";
    }

    public function cargar($conexion)
    {
        $adatos = arrayDatosPDO("nick", "$this->nick");
        $res = selectPrepPDO($conexion, "*", "usuariosGestion", $adatos);
        $res = $res[0];

        $this->setCodUsuarioGestion($res["codUsuarioGestion"]);
        $this->setNombre($res["nombre"]);
    }


    /**
     * @return string
     */
    public function getCodUsuarioGestion()
    {
        return $this->codUsuarioGestion;
    }

    /**
     * @param string $codUsuarioGestion
     */
    public function setCodUsuarioGestion($codUsuarioGestion)
    {
        $this->codUsuarioGestion = $codUsuarioGestion;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
    public function getEmail()
    {
        return "gestor@trabajoFinal.com";
    }


}