<?php

namespace izv\data;

/**
 * Pedido
 */
class Pedido
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $tarjeta;

    /**
     * @var string
     */
    private $fechavalidez;

    /**
     * @var string
     */
    private $cvv;

    /**
     * @var \izv\data\Usuario
     */
    private $usuario;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tarjeta
     *
     * @param string $tarjeta
     *
     * @return Pedido
     */
    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    /**
     * Get tarjeta
     *
     * @return string
     */
    public function getTarjeta()
    {
        return $this->tarjeta;
    }

    /**
     * Set fechavalidez
     *
     * @param string $fechavalidez
     *
     * @return Pedido
     */
    public function setFechavalidez($fechavalidez)
    {
        $this->fechavalidez = $fechavalidez;

        return $this;
    }

    /**
     * Get fechavalidez
     *
     * @return string
     */
    public function getFechavalidez()
    {
        return $this->fechavalidez;
    }

    /**
     * Set cvv
     *
     * @param string $cvv
     *
     * @return Pedido
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * Get cvv
     *
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set usuario
     *
     * @param \izv\data\Usuario $usuario
     *
     * @return Pedido
     */
    public function setUsuario(\izv\data\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \izv\data\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

