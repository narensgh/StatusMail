<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamMember
 *
 * @ORM\Table(name="team_member", uniqueConstraints={@ORM\UniqueConstraint(name="team_id", columns={"team_id", "user_id"})}, indexes={@ORM\Index(name="team_id_2", columns={"team_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class TeamMember
{
    /**
     * @var integer
     *
     * @ORM\Column(name="team_member_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamMemberId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_lead", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isLead;

    /**
     * @var \Management\Model\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="team_id", nullable=true)
     * })
     */
    private $team;

    /**
     * @var \Management\Model\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=true)
     * })
     */
    private $user;


    /**
     * Get teamMemberId
     *
     * @return integer 
     */
    public function getTeamMemberId()
    {
        return $this->teamMemberId;
    }

    /**
     * Set isLead
     *
     * @param boolean $isLead
     * @return TeamMember
     */
    public function setIsLead($isLead)
    {
        $this->isLead = $isLead;

        return $this;
    }

    /**
     * Get isLead
     *
     * @return boolean 
     */
    public function getIsLead()
    {
        return $this->isLead;
    }

    /**
     * Set team
     *
     * @param \Management\Model\Entity\Team $team
     * @return TeamMember
     */
    public function setTeam(\Management\Model\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Management\Model\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set user
     *
     * @param \Management\Model\Entity\User $user
     * @return TeamMember
     */
    public function setUser(\Management\Model\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Management\Model\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
