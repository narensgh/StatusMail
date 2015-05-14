<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PmDiscussion
 *
 * @ORM\Table(name="pm_discussion", indexes={@ORM\Index(name="todo_id", columns={"todo_id"}), @ORM\Index(name="added_by", columns={"added_by"}), @ORM\Index(name="edited_by", columns={"edited_by"})})
 * @ORM\Entity
 */
class PmDiscussion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="discussion_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $discussionId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment", type="string", nullable=false)
     */
    private $attachment = 'false';

    /**
     * @var string
     *
     * @ORM\Column(name="attachment_path", type="string", length=250, nullable=false)
     */
    private $attachmentPath;

    /**
     * @var integer
     *
     * @ORM\Column(name="added_by", type="integer", nullable=false)
     */
    private $addedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="edited", type="string", nullable=false)
     */
    private $edited = 'false';

    /**
     * @var integer
     *
     * @ORM\Column(name="edited_by", type="integer", nullable=false)
     */
    private $editedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_edited", type="datetime", nullable=false)
     */
    private $dateEdited;

    /**
     * @var \Application\Model\Entity\Todo
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Entity\Todo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="todo_id", referencedColumnName="todo_id")
     * })
     */
    private $todo;



    /**
     * Get discussionId
     *
     * @return integer 
     */
    public function getDiscussionId()
    {
        return $this->discussionId;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PmDiscussion
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set attachment
     *
     * @param string $attachment
     * @return PmDiscussion
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     *
     * @return string 
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set attachmentPath
     *
     * @param string $attachmentPath
     * @return PmDiscussion
     */
    public function setAttachmentPath($attachmentPath)
    {
        $this->attachmentPath = $attachmentPath;

        return $this;
    }

    /**
     * Get attachmentPath
     *
     * @return string 
     */
    public function getAttachmentPath()
    {
        return $this->attachmentPath;
    }

    /**
     * Set addedBy
     *
     * @param integer $addedBy
     * @return PmDiscussion
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return integer 
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Set edited
     *
     * @param string $edited
     * @return PmDiscussion
     */
    public function setEdited($edited)
    {
        $this->edited = $edited;

        return $this;
    }

    /**
     * Get edited
     *
     * @return string 
     */
    public function getEdited()
    {
        return $this->edited;
    }

    /**
     * Set editedBy
     *
     * @param integer $editedBy
     * @return PmDiscussion
     */
    public function setEditedBy($editedBy)
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    /**
     * Get editedBy
     *
     * @return integer 
     */
    public function getEditedBy()
    {
        return $this->editedBy;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return PmDiscussion
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
     * Set dateEdited
     *
     * @param \DateTime $dateEdited
     * @return PmDiscussion
     */
    public function setDateEdited($dateEdited)
    {
        $this->dateEdited = $dateEdited;

        return $this;
    }

    /**
     * Get dateEdited
     *
     * @return \DateTime 
     */
    public function getDateEdited()
    {
        return $this->dateEdited;
    }

    /**
     * Set todo
     *
     * @param \Application\Model\Entity\Todo $todo
     * @return PmDiscussion
     */
    public function setTodo(\Application\Model\Entity\Todo $todo = null)
    {
        $this->todo = $todo;

        return $this;
    }

    /**
     * Get todo
     *
     * @return \Application\Model\Entity\Todo 
     */
    public function getTodo()
    {
        return $this->todo;
    }
}
