<?php
/**
 * @Entity @Table(name="user")
 */
class User {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=120, unique=true, nullable=false)
     */
    private $email;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $password;
    
    /**
     * @Column(type="string", length=15, nullable=true)
     */
    private $type;
    
    /** @OneToMany(targetEntity="Post", mappedBy="user") */
    private $posts;
}