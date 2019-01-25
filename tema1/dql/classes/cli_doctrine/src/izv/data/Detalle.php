<?php

namespace izv\data;

/**
 * Detalle
 */
class Detalle
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $numero;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var string
     */
    private $precio;

    /**
     * @var \izv\data\Pedido
     */
    private $pedido;

    /**
     * @var \izv\data\Zapato
     */
    private $zapato;


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

