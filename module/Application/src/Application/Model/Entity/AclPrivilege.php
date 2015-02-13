<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclPrivilege
 *
 * @ORM\Table(name="acl_privilege")
 * @ORM\Entity
 */
class AclPrivilege
{
    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $privilegeId;

    /**
     * @var string
     *
     * @ORM\Column(name="privilege_name", type="string", length=100, nullable=false)
     */
    private $privilegeName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;



    /**
     * Get privilegeId
     *
     * @return integer 
     */
    public function getPrivilegeId()
    {
        return $this->privilegeId;
    }

    /**
     * Set privilegeName
     *
     * @param string $privilegeName
     * @return AclPrivilege
     */
    public function setPrivilegeName($privilegeName)
    {
        $this->privilegeName = $privilegeName;

        return $this;
    }

    /**
     * Get privilegeName
     *
     * @return string 
     */
    public function getPrivilegeName()
    {
        return $this->privilegeName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AclPrivilege
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
}
