<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessToken
 *
 * @ORM\Table(name="access_token", indexes={@ORM\Index(name="people_id", columns={"people_id", "auth_token"})})
 * @ORM\Entity
 */
class AccessToken
{
    /**
     * @var integer
     *
     * @ORM\Column(name="access_token_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accessTokenId;

    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=false)
     */
    private $peopleId;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_token", type="string", length=64, nullable=false)
     */
    private $authToken;

    /**
     * @var string
     *
     * @ORM\Column(name="expired", type="string", nullable=false)
     */
    private $expired = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime = 'CURRENT_TIMESTAMP';



    /**
     * Get accessTokenId
     *
     * @return integer 
     */
    public function getAccessTokenId()
    {
        return $this->accessTokenId;
    }

    /**
     * Set peopleId
     *
     * @param integer $peopleId
     * @return AccessToken
     */
    public function setPeopleId($peopleId)
    {
        $this->peopleId = $peopleId;

        return $this;
    }

    /**
     * Get peopleId
     *
     * @return integer 
     */
    public function getPeopleId()
    {
        return $this->peopleId;
    }

    /**
     * Set authToken
     *
     * @param string $authToken
     * @return AccessToken
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;

        return $this;
    }

    /**
     * Get authToken
     *
     * @return string 
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * Set expired
     *
     * @param string $expired
     * @return AccessToken
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return string 
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return AccessToken
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }
}
