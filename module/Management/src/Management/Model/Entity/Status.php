<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status", indexes={@ORM\Index(name="FK_status_user", columns={"user_id"}), @ORM\Index(name="task_id", columns={"task_id"})})
 * @ORM\Entity
 */
class Status
{
    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $statusId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2048, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \Management\Model\Entity\Task
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\Task", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="task_id", referencedColumnName="task_id")
     * })
     */
    private $task;

    /**
     * @var \Management\Model\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Status
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Status
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set task
     *
     * @param \Management\Model\Entity\Task $task
     * @return Status
     */
    public function setTask(\Management\Model\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Management\Model\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set user
     *
     * @param \Management\Model\Entity\User $user
     * @return Status
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
