<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subgenre
 *
 * @ORM\Table(name="subgenre", indexes={@ORM\Index(name="genre_id", columns={"genre_id"})})
 * @ORM\Entity
 */
class Subgenre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="orchard_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orchardId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=240, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="music_video", type="string", length=3, nullable=true)
     */
    private $musicVideo;

    /**
     * @var \Management\Model\Entity\Genre
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre_id", referencedColumnName="genre_id")
     * })
     */
    private $genre;



    /**
     * Get orchardId
     *
     * @return integer 
     */
    public function getOrchardId()
    {
        return $this->orchardId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Subgenre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set musicVideo
     *
     * @param string $musicVideo
     * @return Subgenre
     */
    public function setMusicVideo($musicVideo)
    {
        $this->musicVideo = $musicVideo;

        return $this;
    }

    /**
     * Get musicVideo
     *
     * @return string 
     */
    public function getMusicVideo()
    {
        return $this->musicVideo;
    }

    /**
     * Set genre
     *
     * @param \Management\Model\Entity\Genre $genre
     * @return Subgenre
     */
    public function setGenre(\Management\Model\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \Management\Model\Entity\Genre 
     */
    public function getGenre()
    {
        return $this->genre;
    }
}
