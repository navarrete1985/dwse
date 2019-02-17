<?php

namespace izv\data;

/**
 * @Entity @Table(name="categoria",
 *              uniqueConstraints={@UniqueConstraint(name="catconstr", columns={"idusuario", "categoria"})})
 * id, id_usuario, categoria
 */
class Categoria{
    
    use \izv\common\Common;
    
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=200, nullable=false)
     */
    private $categoria;
    
    /*-------------------RELACIONES------------------*/
    /**
     * @OneToMany(targetEntity="Link", mappedBy="categoria") 
     */
    private $links;
    
    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="categorias") 
     * @JoinColumn(name="idusuario", referencedColumnName="id", nullable=false)
     */
    private $usuario;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add link
     *
     * @param \Link $link
     *
     * @return Categoria
     */
    public function addLink(Link $link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * Remove link
     *
     * @param \Link $link
     */
    public function removeLink(Link $link)
    {
        $this->links->removeElement($link);
    }

    /**
     * Get links
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set usuario
     *
     * @param \Usuario $usuario
     *
     * @return Categoria
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
