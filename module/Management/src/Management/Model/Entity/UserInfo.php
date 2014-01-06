<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserInfo
 *
 * @ORM\Table(name="user_info", uniqueConstraints={@ORM\UniqueConstraint(name="login_id", columns={"loginid"})})
 * @ORM\Entity
 */
class UserInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255, nullable=false)
     */
    private $fullname;

    /**
     * @var integer
     *
     * @ORM\Column(name="contact_no", type="bigint", nullable=false)
     */
    private $contactNo;

    /**
     * @var string
     *
     * @ORM\Column(name="email_id", type="string", length=255, nullable=false)
     */
    private $emailId;

    /**
     * @var \Management\Model\Entity\Login
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\Login")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="loginid", referencedColumnName="loginid")
     * })
     */
    private $loginid;



    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return UserInfo
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set contactNo
     *
     * @param integer $contactNo
     * @return UserInfo
     */
    public function setContactNo($contactNo)
    {
        $this->contactNo = $contactNo;

        return $this;
    }

    /**
     * Get contactNo
     *
     * @return integer 
     */
    public function getContactNo()
    {
        return $this->contactNo;
    }

    /**
     * Set emailId
     *
     * @param string $emailId
     * @return UserInfo
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * Get emailId
     *
     * @return string 
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * Set loginid
     *
     * @param \Management\Model\Entity\Login $loginid
     * @return UserInfo
     */
    public function setLoginid(\Management\Model\Entity\Login $loginid = null)
    {
        $this->loginid = $loginid;

        return $this;
    }

    /**
     * Get loginid
     *
     * @return \Management\Model\Entity\Login 
     */
    public function getLoginid()
    {
        return $this->loginid;
    }
}
