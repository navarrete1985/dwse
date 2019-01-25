<?php

namespace izv\data;

/**
 * @Entity @Table(name="detalle")
 */
class Detalle {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="Pedido", inversedBy="detalles")
     * @JoinColumn(name="idpedido", referencedColumnName="id", nullable=false)
    */
    private $pedido;
    
    /**
     * @ManyToOne(targetEntity="Zapato", inversedBy="detalles")
     * @JoinColumn(name="idzapato", referencedColumnName="id", nullable=false)
    */
    private $zapato;
    
    /**
     * @Column(type="smallint", nullable=false, precision=2) 
     */
    private $numero;
    
    /**
     * @Column(type="smallint", nullable=false, precision=2) 
     */
    private $cantidad;
    
    /**
     * @Column(type="decimal", nullable=false, precision=7, scale=2) 
     */
    private $precio;

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Detalle
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Detalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Detalle
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set pedido
     *
     * @param \izv\data\Pedido $pedido
     *
     * @return Detalle
     */
    public function setPedido(\izv\data\Pedido $pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \izv\data\Pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set zapato
     *
     * @param \izv\data\Zapato $zapato
     *
     * @return Detalle
     */
    public function setZapato(\izv\data\Zapato $zapato)
    {
        $this->zapato = $zapato;

        return $this;
    }

    /**
     * Get zapato
     *
     * @return \izv\data\Zapato
     */
    public function getZapato()
    {
        return $this->zapato;
    }
}

