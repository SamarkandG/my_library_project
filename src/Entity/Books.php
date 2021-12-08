<?php
// Dans mon entity je suis obligée de créer à la main des "getters" et "setters" pour que symfony puisse aller
// chercher mes données en base de données

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */

class Books
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */

    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPages;


    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     */
    private $author;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getnbPages()
    {
        return $this->nbPages;
    }

    /**
     * @param mixed $nbPages
     */
    public function setnbPages($nbPages): void
    {
        $this->nbPages = $nbPages;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

}