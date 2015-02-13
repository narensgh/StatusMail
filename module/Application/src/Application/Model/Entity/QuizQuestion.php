<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizQuestion
 *
 * @ORM\Table(name="quiz_question")
 * @ORM\Entity
 */
class QuizQuestion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ques_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $quesId;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=500, nullable=true)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_option", type="string", nullable=true)
     */
    private $answerOption;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';



    /**
     * Get quesId
     *
     * @return integer 
     */
    public function getQuesId()
    {
        return $this->quesId;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return QuizQuestion
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answerOption
     *
     * @param string $answerOption
     * @return QuizQuestion
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
     * @return QuizQuestion
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
