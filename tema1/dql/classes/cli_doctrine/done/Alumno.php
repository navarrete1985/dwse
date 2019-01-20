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
     * @Column(type="string", length=120, nullable=true)
     */
    private $abservaciones;

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
     * Set abservaciones
     *
     * @param string $abservaciones
     *
     * @return Alumno
     */
    public function setAbservaciones($abservaciones)
    {
        $this->abservaciones = $abservaciones;

        return $this;
    }

    /**
     * Get abservaciones
     *
     * @return string
     */
    public function getAbservaciones()
    {
        return $this->abservaciones;
    }
}
