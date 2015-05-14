<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

/**
 * Description of PmprojectService
 *
 * @author narendra.singh
 */

use Application\Model\Entity\PmDiscussion;

class PmdiscussionService
{
    private $_em;

    /**
     *
     * @param type $em
     */

    function __construct($em)
    {
        if(empty($this->_em)){
            $this->_em = $em;
        }
    }

    
    public function getTodobyId($todoId) 
    {
         $todo = $this->_em->getRepository('Application\Model\Entity\Todo')
                 ->findOneBy(array ('todoId' => $todoId));
        return $todo;
    }
    /**
     * 
     * @param type $todoId
     */
    public function getDiscussion($todoId = null)
    {
        $todo = $this->getTodobyId($todoId);
        $discussionObj = $this->_em->getRepository('Application\Model\Entity\PmDiscussion')
                ->findByTodo(array ('todo' => $todo));
        $discussions = array();
        foreach ($discussionObj as $discussion) {
            $list['discussionId'] = $discussion->getDiscussionId();
            $list['content'] = $discussion->getContent();
            $list['addedBy'] = $discussion->getAddedBy();
            $list['dateAdded'] = $discussion->getDateAdded()->format('Y-m-d H:i:s');
            $discussions[] = $list;
        }
        return $discussions;
    }

    /**
     * 
     * @param type $data
     */
    public function saveDiscussion($data)
    {
        
    }

}
