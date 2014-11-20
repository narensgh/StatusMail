<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="team_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamId;

    /**
     * @var string
     *
     * @ORM\Column(name="team_name", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $teamName;

    /**
     * @var string
     *
     * @ORM\Column(name="team_abbr", type="string", length=6, precision=0, scale=0, nullable=true, unique=false)
     */
    private $teamAbbr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createdOn;


    /**
     * Get teamId
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set teamName
     *
     * @param string $teamName
     * @return Team
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string 
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set teamAbbr
     *
     * @param string $teamAbbr
     * @return Team
     */
    public function setTeamAbbr($teamAbbr)
    {
        $this->teamAbbr = $teamAbbr;

        return $this;
    }

    /**
     * Get teamAbbr
     *
     * @return string 
     */
    public function getTeamAbbr()
    {
        return $this->teamAbbr;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Team
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}
