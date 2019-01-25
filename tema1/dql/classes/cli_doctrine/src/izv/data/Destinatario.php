<?php

namespace izv\data;

/**
 * Destinatario
 */
class Destinatario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zapatos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->zapatos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Destinatario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add zapato
     *
     * @param \izv\data\Zapato $zapato
     *
     * @return Destinatario
     */
    public function addZapato(\izv\data\Zapato $zapato)
    {
        $this->zapatos[] = $zapato;

        return $this;
    }

    /**
     * Remove zapato
     *
     * @param \izv\data\Zapato $zapato
     */
    public function removeZapato(\izv\data\Zapato $zapato)
    {
        $this->zapatos->removeElement($zapato);
    }

    /**
     * Get zapatos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZapatos()
    {
        return $this->zapatos;
    }
}

