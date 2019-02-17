<?php

namespace izv\data;

/**
 * @Entity @Table(name="link",
 *          uniqueConstraints={@UniqueConstraint(name="linkconstr", columns={"idusuario", "idcategoria", "href"})})
 * id, id_cat, id_user, href, comentario
 */
class Link {

    use \izv\common\Common;

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255 ,nullable=false)
     */
    private $href;

    /**
     * @Column(type="text", nullable=false)
     */
    private $comentario;


    /*----------------RELACIONES------------------*/
    /**
     * @ManyToOne(targetEntity="Categoria", inversedBy="links")
     * @JoinColumn(name="idcategoria", referencedColumnName="id", nullable=false)
     */
    private $categoria;

    /** @ManyToOne(targetEntity="Usuario", inversedBy="links") 
    *   @JoinColumn(name="idusuario", referencedColumnName="id", nullable=false)
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
     * Set href
     *
     * @param string $href
     *
     * @return Link
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Link
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set categoria
     *
     * @param \Categoria $categoria
     *
     * @return Link
     */
    public function setCategoria(Categoria $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set usuario
     *
     * @param \Usuario $usuario
     *
     * @return Link
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
