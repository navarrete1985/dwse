<?php
//id, fecha, usuario, tarjeta, fechavalidez, cvv

namespace izv\data;

/**
 * @Entity @Table(name="pedido")
 */
class Pedido {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="datetime", nullable=false)
     */
    private $fecha;
    
    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="pedidos")
     * @JoinColumn(name="idusuario", referencedColumnName="id", nullable=false)
    */
    private $usuario;
    
    /**
     * @Column(type="string", length=16, nullable=false)
     */
    private $tarjeta;
    
    /**
     * @Column(type="string", length=5, nullable=false)
     */
    private $fechavalidez;
    
    /**
     * @Column(type="string", length=3, nullable=false)
     */
    private $cvv;
    
}