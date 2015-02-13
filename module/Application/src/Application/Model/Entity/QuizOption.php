<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizOption
 *
 * @ORM\Table(name="quiz_option", uniqueConstraints={@ORM\UniqueConstraint(name="question_id", columns={"question_id"})})
 * @ORM\Entity
 */
class QuizOption
{
    /**
     * @var integer
     *
     * @ORM\Column(name="option_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $optionId;

    /**
     * @var string
     *
     * @ORM\Column(name="option_desc1", type="string", length=250, nullable=true)
     */
    private $optionDesc1;

    /**
     * @var string
     *
     * @ORM\Column(name="option_desc2", type="string", length=250, nullable=true)
     */
    private $optionDesc2;

    /**
     * @var string
     *
     * @ORM\Column(name="option_desc3", type="string", length=250, nullable=true)
     */
    private $optionDesc3;

    /**
     * @var string
     *
     * @ORM\Column(name="option_desc4", type="string", length=250, nullable=true)
     */
    private $optionDesc4;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var \Application\Model\Entity\QuizQuestion
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Entity\QuizQuestion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="ques_id")
     * })
     */
    private $question;



    /**
     * Get optionId
     *
     * @return integer 
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * Set optionDesc1
     *
     * @param string $optionDesc1
     * @return QuizOption
     */
    public function setOptionDesc1($optionDesc1)
    {
        $this->optionDesc1 = $optionDesc1;

        return $this;
    }

    /**
     * Get optionDesc1
     *
     * @return string 
     */
    public function getOptionDesc1()
    {
        return $this->optionDesc1;
    }

    /**
     * Set optionDesc2
     *
     * @param string $optionDesc2
     * @return QuizOption
     */
    public function setOptionDesc2($optionDesc2)
    {
        $this->optionDesc2 = $optionDesc2;

        return $this;
    }

    /**
     * Get optionDesc2
     *
     * @return string 
     */
    public function getOptionDesc2()
    {
        return $this->optionDesc2;
    }

    /**
     * Set optionDesc3
     *
     * @param string $optionDesc3
     * @return QuizOption
     */
    public function setOptionDesc3($optionDesc3)
    {
        $this->optionDesc3 = $optionDesc3;

        return $this;
    }

    /**
     * Get optionDesc3
     *
     * @return string 
     */
    public function getOptionDesc3()
    {
        return $this->optionDesc3;
    }

    /**
     * Set optionDesc4
     *
     * @param string $optionDesc4
     * @return QuizOption
     */
    public function setOptionDesc4($optionDesc4)
    {
        $this->optionDesc4 = $optionDesc4;

        return $this;
    }

    /**
     * Get optionDesc4
     *
     * @return string 
     */
    public function getOptionDesc4()
    {
        return $this->optionDesc4;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return QuizOption
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
     * Set question
     *
     * @param \Application\Model\Entity\QuizQuestion $question
     * @return QuizOption
     */
    public function setQuestion(\Application\Model\Entity\QuizQuestion $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Application\Model\Entity\QuizQuestion 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
