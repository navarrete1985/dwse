<?php

namespace izv\data;

/**
 * Zapato
 */
class Zapato
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $marca;

    /**
     * @var string
     */
    private $modelo;

    /**
     * @var string
     */
    private $precio;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $cubierta;

    /**
     * @var string
     */
    private $forro;

    /**
     * @var string
     */
    private $suela;

    /**
     * @var integer
     */
    private $numerodesde;

    /**
     * @var integer
     */
    private $numerohasta;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var boolean
     */
    private $disponible;

    /**
     * @var \izv\data\Categoria
     */
    private $categoria;

    /**
     * @var \izv\data\Destinatario
     */
    private $destinatario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $detalles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set marca
     *
     * @param string $marca
     *
     * @return Zapato
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     *
     * @return Zapato
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Zapato
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
     * Set color
     *
     * @param string $color
     *
     * @return Zapato
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set cubierta
     *
     * @param string $cubierta
     *
     * @return Zapato
     */
    public function setCubierta($cubierta)
    {
        $this->cubierta = $cubierta;

        return $this;
    }

    /**
     * Get cubierta
     *
     * @return string
     */
    public function getCubierta()
    {
        return $this->cubierta;
    }

    /**
     * Set forro
     *
     * @param string $forro
     *
     * @return Zapato
     */
    public function setForro($forro)
    {
        $this->forro = $forro;

        return $this;
    }

    /**
     * Get forro
     *
     * @return string
     */
    public function getForro()
    {
        return $this->forro;
    }

    /**
     * Set suela
     *
     * @param string $suela
     *
     * @return Zapato
     */
    public function setSuela($suela)
    {
        $this->suela = $suela;

        return $this;
    }

    /**
     * Get suela
     *
     * @return string
     */
    public function getSuela()
    {
        return $this->suela;
    }

    /**
     * Set numerodesde
     *
     * @param integer $numerodesde
     *
     * @return Zapato
     */
    public function setNumerodesde($numerodesde)
    {
        $this->numerodesde = $numerodesde;

        return $this;
    }

    /**
     * Get numerodesde
     *
     * @return integer
     */
    public function getNumerodesde()
    {
        return $this->numerodesde;
    }

    /**
     * Set numerohasta
     *
     * @param integer $numerohasta
     *
     * @return Zapato
     */
    public function setNumerohasta($numerohasta)
    {
        $this->numerohasta = $numerohasta;

        return $this;
    }

    /**
     * Get numerohasta
     *
     * @return integer
     */
    public function getNumerohasta()
    {
        return $this->numerohasta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Zapato
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Zapato
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set categoria
     *
     * @param \izv\data\Categoria $categoria
     *
     * @return Zapato
     */
    public function setCategoria(\izv\data\Categoria $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \izv\data\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set destinatario
     *
     * @param \izv\data\Destinatario $destinatario
     *
     * @return Zapato
     */
    public function setDestinatario(\izv\data\Destinatario $destinatario)
    {
        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * Get destinatario
     *
     * @return \izv\data\Destinatario
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Add detalle
     *
     * @param \izv\data\Detalle $detalle
     *
     * @return Zapato
     */
    public function addDetalle(\izv\data\Detalle $detalle)
    {
        $this->detalles[] = $detalle;

        return $this;
    }

    /**
     * Remove detalle
     *
     * @param \izv\data\Detalle $detalle
     */
    public function removeDetalle(\izv\data\Detalle $detalle)
    {
        $this->detalles->removeElement($detalle);
    }

    /**
     * Get detalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetalles()
    {
        return $this->detalles;
    }
}

