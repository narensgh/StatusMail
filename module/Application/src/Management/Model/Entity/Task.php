<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task
{
    /**
     * @var integer
     *
     * @ORM\Column(name="task_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taskId;

    /**
     * @var string
     *
     * @ORM\Column(name="jira_ticket_id", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $jiraTicketId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;


    /**
     * Get taskId
     *
     * @return integer 
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Set jiraTicketId
     *
     * @param string $jiraTicketId
     * @return Task
     */
    public function setJiraTicketId($jiraTicketId)
    {
        $this->jiraTicketId = $jiraTicketId;

        return $this;
    }

    /**
     * Get jiraTicketId
     *
     * @return string 
     */
    public function getJiraTicketId()
    {
        return $this->jiraTicketId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
