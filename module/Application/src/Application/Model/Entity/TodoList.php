<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TodoList
 *
 * @ORM\Table(name="todo_list", indexes={@ORM\Index(name="project_id", columns={"project_id"})})
 * @ORM\Entity
 */
class TodoList
{
    /**
     * @var integer
     *
     * @ORM\Column(name="todo_list_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $todoListId;

    /**
     * @var string
     *
     * @ORM\Column(name="listname", type="string", length=255, nullable=false)
     */
    private $listname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime", nullable=false)
     */
    private $dateModified = 'CURRENT_TIMESTAMP';

    /**
     * @var \Application\Model\Entity\PmProject
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Entity\PmProject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     * })
     */
    private $project;



    /**
     * Get todoListId
     *
     * @return integer 
     */
    public function getTodoListId()
    {
        return $this->todoListId;
    }

    /**
     * Set listname
     *
     * @param string $listname
     * @return TodoList
     */
    public function setListname($listname)
    {
        $this->listname = $listname;

        return $this;
    }

    /**
     * Get listname
     *
     * @return string 
     */
    public function getListname()
    {
        return $this->listname;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return TodoList
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
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return TodoList
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set project
     *
     * @param \Application\Model\Entity\PmProject $project
     * @return TodoList
     */
    public function setProject(\Application\Model\Entity\PmProject $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Application\Model\Entity\PmProject 
     */
    public function getProject()
    {
        return $this->project;
    }
}
