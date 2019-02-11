<?php

namespace izv\data;

/**
 * @Entity @Table(name="categoria",
 *              uniqueConstraints={@UniqueConstraint(name="catconstr", columns={"idusuario", "categoria"})})
 * id, id_usuario, categoria
 */
class Categoria{
    
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
     * @OneToOne(targetEntity="Link", inversedBy="categoria")
     * @JoinColumn(name="idcategoria", referencedColumnName="id")
     */
    private $link;
    
    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="categorias") 
     * @JoinColumn(name="idusuario", referencedColumnName="id", nullable=false)
     */
    private $usuario;

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
     * Set link
     *
     * @param \Link $link
     *
     * @return Categoria
     */
    public function setLink(\Link $link = null)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return \Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set usuario
     *
     * @param \Usuario $usuario
     *
     * @return Categoria
     */
    public function setUsuario(\Usuario $usuario)
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
