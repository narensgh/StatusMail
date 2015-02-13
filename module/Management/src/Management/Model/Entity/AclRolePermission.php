<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclRolePermission
 *
 * @ORM\Table(name="acl_role_permission", indexes={@ORM\Index(name="permission_id", columns={"permission_id", "role_id"}), @ORM\Index(name="role_id", columns={"role_id"}), @ORM\Index(name="IDX_73CBAD59FED90CCA", columns={"permission_id"})})
 * @ORM\Entity
 */
class AclRolePermission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="role_permission_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rolePermissionId;

    /**
     * @var string
     *
     * @ORM\Column(name="allowed", type="string", nullable=false)
     */
    private $allowed = 'N';

    /**
     * @var \Management\Model\Entity\AclPermission
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\AclPermission")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permission_id", referencedColumnName="permission_id")
     * })
     */
    private $permission;

    /**
     * @var \Management\Model\Entity\AclRole
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\AclRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     * })
     */
    private $role;



    /**
     * Get rolePermissionId
     *
     * @return integer 
     */
    public function getRolePermissionId()
    {
        return $this->rolePermissionId;
    }

    /**
     * Set allowed
     *
     * @param string $allowed
     * @return AclRolePermission
     */
    public function setAllowed($allowed)
    {
        $this->allowed = $allowed;

        return $this;
    }

    /**
     * Get allowed
     *
     * @return string 
     */
    public function getAllowed()
    {
        return $this->allowed;
    }

    /**
     * Set permission
     *
     * @param \Management\Model\Entity\AclPermission $permission
     * @return AclRolePermission
     */
    public function setPermission(\Management\Model\Entity\AclPermission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return \Management\Model\Entity\AclPermission 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set role
     *
     * @param \Management\Model\Entity\AclRole $role
     * @return AclRolePermission
     */
    public function setRole(\Management\Model\Entity\AclRole $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Management\Model\Entity\AclRole 
     */
    public function getRole()
    {
        return $this->role;
    }
}
