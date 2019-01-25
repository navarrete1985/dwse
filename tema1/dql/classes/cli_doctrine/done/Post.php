<?php
/**
 * @Entity @Table(name="post",
 *                uniqueConstraints={@UniqueConstraint(name="restriccion", columns={"iduser", "date"})}
 * )
 */
class Post {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="date", nullable=false)
     */
    private $date;

    /**
     * @Column(type="text", nullable=false)
     */
    private $text;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     * @JoinColumn(name="iduser", referencedColumnName="id", nullable=false)
    */
    private $user;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return Post
     */
    public function setUser(\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }
}
