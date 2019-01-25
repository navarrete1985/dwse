<?php
/**
 * @Entity @Table(name="alumno")
 */
class Alumno {
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string", length=120, unique=true, nullable=false)
     */
    private $nombre;
    /**
     * @Column(type="string", length=200, nullable=true)
     */
    private $observaciones;

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
     * @return Alumno
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Alumno
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
