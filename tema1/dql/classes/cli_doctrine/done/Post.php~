<?php
/**
 * @Entity @Table(name="post")
 */
class Post {

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="datetime", nullable=false)
     */
    private $date;

    /**
     * @Column(type="text", nullable=false)
     */
    private $text;

    /** @ManyToOne(targetEntity="User", inversedBy="posts") */
    private $user;
}