<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizAnswer
 *
 * @ORM\Table(name="quiz_answer", indexes={@ORM\Index(name="question_id", columns={"question_id"})})
 * @ORM\Entity
 */
class QuizAnswer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="answer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $answerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_option", type="string", nullable=true)
     */
    private $answerOption;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="date", nullable=true)
     */
    private $dateAdded;

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
     * Get answerId
     *
     * @return integer 
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return QuizAnswer
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

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
     * Set answerOption
     *
     * @param string $answerOption
     * @return QuizAnswer
     */
    public function setAnswerOption($answerOption)
    {
        $this->answerOption = $answerOption;

        return $this;
    }

    /**
     * Get answerOption
     *
     * @return string 
     */
    public function getAnswerOption()
    {
        return $this->answerOption;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return QuizAnswer
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
     * @return QuizAnswer
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
