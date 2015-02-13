<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclPermission
 *
 * @ORM\Table(name="acl_permission", indexes={@ORM\Index(name="resource_id", columns={"resource_id", "privilege_id"}), @ORM\Index(name="privilege_id", columns={"privilege_id"}), @ORM\Index(name="IDX_B68D53BF89329D25", columns={"resource_id"})})
 * @ORM\Entity
 */
class AclPermission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="permission_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $permissionId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \Management\Model\Entity\AclResource
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\AclResource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="resource_id")
     * })
     */
    private $resource;

    /**
     * @var \Management\Model\Entity\AclPrivilege
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\AclPrivilege")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="privilege_id", referencedColumnName="privilege_id")
     * })
     */
    private $privilege;



    /**
     * Get permissionId
     *
     * @return integer 
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AclPermission
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
     * Set resource
     *
     * @param \Management\Model\Entity\AclResource $resource
     * @return AclPermission
     */
    public function setResource(\Management\Model\Entity\AclResource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Management\Model\Entity\AclResource 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set privilege
     *
     * @param \Management\Model\Entity\AclPrivilege $privilege
     * @return AclPermission
     */
    public function setPrivilege(\Management\Model\Entity\AclPrivilege $privilege = null)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return \Management\Model\Entity\AclPrivilege 
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }
}
