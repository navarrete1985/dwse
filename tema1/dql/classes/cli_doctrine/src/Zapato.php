<?php
//id, marca, modelo, categoría, destinatario, precio, color, cubierta, forro, suela,
//numerodesde, numerohasta, descripción, disponible

namespace izv\data;

/**
 * @Entity @Table(name="zapato")
 */
class Zapato {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $marca;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $modelo;
    
    /**
     * @ManyToOne(targetEntity="Categoria", inversedBy="zapatos")
     * @JoinColumn(name="idcategoria", referencedColumnName="id", nullable=false)
    */
    private $categoria;
    
    /**
     * @ManyToOne(targetEntity="Destinatario", inversedBy="zapatos")
     * @JoinColumn(name="iddestinatario", referencedColumnName="id", nullable=false)
    */
    private $destinatario;
    
    /**
     * @Column(type="decimal", nullable=false, precision=7, scale=2) 
     */
    private $precio;

    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $color;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $cubierta;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $forro;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $suela;
    
    /**
     * @Column(type="smallint", nullable=false, precision=2) 
     */
    private $numerodesde;
    
    /**
     * @Column(type="smallint", nullable=false, precision=2) 
     */
    private $numerohasta;
    
    /**
     * @Column(type="text", nullable=true)
     */
    private $descripcion;
    
    /**
     * @Column(type="boolean", nullable=false, precision=1)
     */
    private $disponible;
    
    /** 
     * @OneToMany(targetEntity="Detalle", mappedBy="zapato") 
    */
    private $detalles;
    
}