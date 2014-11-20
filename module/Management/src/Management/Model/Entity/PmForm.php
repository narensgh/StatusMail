<?php

namespace Management\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PmForm
 *
 * @ORM\Table(name="pm_form", indexes={@ORM\Index(name="project_id", columns={"project_id"})})
 * @ORM\Entity
 */
class PmForm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="form_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $formId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="field_ids", type="string", length=255, nullable=false)
     */
    private $fieldIds;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime", nullable=false)
     */
    private $dateModified = '0000-00-00 00:00:00';

    /**
     * @var \Management\Model\Entity\PmProject
     *
     * @ORM\ManyToOne(targetEntity="Management\Model\Entity\PmProject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     * })
     */
    private $project;



    /**
     * Get formId
     *
     * @return integer 
     */
    public function getFormId()
    {
        return $this->formId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PmForm
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fieldIds
     *
     * @param string $fieldIds
     * @return PmForm
     */
    public function setFieldIds($fieldIds)
    {
        $this->fieldIds = $fieldIds;

        return $this;
    }

    /**
     * Get fieldIds
     *
     * @return string 
     */
    public function getFieldIds()
    {
        return $this->fieldIds;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return PmForm
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
     * @return PmForm
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
     * @param \Management\Model\Entity\PmProject $project
     * @return PmForm
     */
    public function setProject(\Management\Model\Entity\PmProject $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Management\Model\Entity\PmProject 
     */
    public function getProject()
    {
        return $this->project;
    }
}
