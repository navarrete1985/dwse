<?php

namespace izv\data;

/**
 * @Entity @Table(name="destinatario")
 */
class Destinatario {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=50, unique=true, nullable=false)
     */
    private $nombre;
    
    /** 
     * @OneToMany(targetEntity="Zapato", mappedBy="destinatario") 
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

