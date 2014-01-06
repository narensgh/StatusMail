<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="genre_id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $genreId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=45, nullable=true)
     */
    private $genre;



    /**
     * Get genreId
     *
     * @return boolean 
     */
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }
}
