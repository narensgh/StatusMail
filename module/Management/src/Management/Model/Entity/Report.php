<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity
 */
class Report
{
    /**
     * @var integer
     *
     * @ORM\Column(name="report_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reportId;

	  /**
     * @var \Management\Model\Entity\UserInfo
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\UserInfo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket_no", type="string", length=10, nullable=false)
     */
    private $ticketNo;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=true)
     */
    private $dateAdded;



    /**
     * Get reportId
     *
     * @return integer 
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Set userId
     *
     * @param \Management\Model\Entity\UserInfo $userId
     * @return Report
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return Management\Model\Entity\UserInfo 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ticketNo
     *
     * @param string $ticketNo
     * @return Report
     */
    public function setTicketNo($ticketNo)
    {
        $this->ticketNo = $ticketNo;

        return $this;
    }

    /**
     * Get ticketNo
     *
     * @return string 
     */
    public function getTicketNo()
    {
        return $this->ticketNo;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Report
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

    /**
     * Set description
     *
     * @param string $description
     * @return Report
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
     * @return Report
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
}
