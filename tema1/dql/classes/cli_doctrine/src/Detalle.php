<?php
//id, pedido, zapato, número, cantidad, precio

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
    
}