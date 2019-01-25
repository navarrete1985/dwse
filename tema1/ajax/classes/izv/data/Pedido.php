<?php

namespace izv\data;

/**
 * @Entity @Table(name="pedido")
 */
class Pedido {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="datetime", nullable=false)
     */
    private $fecha;
    
    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="pedidos")
     * @JoinColumn(name="idusuario", referencedColumnName="id", nullable=false)
    */
    private $usuario;
    
    /**
     * @Column(type="string", length=16, nullable=false)
     */
    private $tarjeta;
    
    /**
     * @Column(type="string", length=5, nullable=false)
     */
    private $fechavalidez;
    
    /**
     * @Column(type="string", length=3, nullable=false)
     */
    private $cvv;

    function __construct() {
        $this->fecha = new \DateTime();
    }

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

