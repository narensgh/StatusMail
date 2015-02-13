<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclResource
 *
 * @ORM\Table(name="acl_resource")
 * @ORM\Entity
 */
class AclResource
{
    /**
     * @var integer
     *
     * @ORM\Column(name="resource_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $resourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=55, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="resource_name", type="string", length=100, nullable=false)
     */
    private $resourceName;



    /**
     * Get resourceId
     *
     * @return integer 
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return AclResource
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set resourceName
     *
     * @param string $resourceName
     * @return AclResource
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;

        return $this;
    }

    /**
     * Get resourceName
     *
     * @return string 
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
}
