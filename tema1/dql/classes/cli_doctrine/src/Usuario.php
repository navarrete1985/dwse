<?php
//id, alias, clave, nombre, apellidos, correo, dirección, fechaalta, activo, administrador

namespace izv\data;

/**
 * @Entity @Table(name="usuario")
 */
class Usuario {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=30, nullable=true, unique=true)
     */
    private $alias;
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $clave;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $nombre;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     */
    private $apellidos;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     */
    private $correo;
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $direccion;
    
    /**
     * @Column(type="date", nullable=false)
     */
    private $fechaalta;
    
    /**
     * @Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $activo = 0;

    /**
     * @Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $administrador = 0;
    
    /** 
     * @OneToMany(targetEntity="Pedido", mappedBy="usuario") 
     */
    private $pedidos;
    
}