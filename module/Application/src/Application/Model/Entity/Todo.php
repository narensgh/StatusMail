<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todo
 *
 * @ORM\Table(name="todo", indexes={@ORM\Index(name="todo_list_id", columns={"todo_list_id"})})
 * @ORM\Entity
 */
class Todo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="todo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $todoId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="assigned_to", type="integer", nullable=false)
     */
    private $assignedTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime", nullable=false)
     */
    private $dateUpdated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", nullable=false)
     */
    private $active = 'yes';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \Application\Model\Entity\TodoList
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Entity\TodoList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="todo_list_id", referencedColumnName="todo_list_id")
     * })
     */
    private $todoList;



    /**
     * Get todoId
     *
     * @return integer 
     */
    public function getTodoId()
    {
        return $this->todoId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Todo
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
     * Set assignedTo
     *
     * @param integer $assignedTo
     * @return Todo
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return integer 
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Todo
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Todo
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Todo
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
     * Set todoList
     *
     * @param \Application\Model\Entity\TodoList $todoList
     * @return Todo
     */
    public function setTodoList(\Application\Model\Entity\TodoList $todoList = null)
    {
        $this->todoList = $todoList;

        return $this;
    }

    /**
     * Get todoList
     *
     * @return \Application\Model\Entity\TodoList 
     */
    public function getTodoList()
    {
        return $this->todoList;
    }
}
