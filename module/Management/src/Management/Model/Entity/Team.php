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
     * @ORM\Column(name="team_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamId;

    /**
     * @var string
     *
     * @ORM\Column(name="team_name", type="string", length=30, nullable=false)
     */
    private $teamName;

    /**
     * @var string
     *
     * @ORM\Column(name="team_abbr", type="string", length=6, nullable=true)
     */
    private $teamAbbr;
    
    /**
     * @var string
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
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
     * @param datetime $createdOn
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
     * @return datetime
     */
    public function getCreatedOn()
    {
    	return $this->createdOn;
    }
    
}

