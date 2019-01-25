<?php
//id, nombre

namespace izv\data;

/**
 * @Entity @Table(name="categoria")
 */
class Categoria {

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
     * @OneToMany(targetEntity="Zapato", mappedBy="categoria") 
    */
    private $zapatos;
    
}
