<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

/**
 * Description of PmfiledController
 *
 * @author narendra.singh
 */
use Application\Controller\BaseController;
use Zend\View\Model\JsonModel;
use Application\Service\PmdiscussionService;

class PmdiscussionController extends BaseController 
{

    public function get($id) 
    {
        return new JsonModel(array('Method not allowed..!! : ' . $id));
    }

    public function getList() 
    {
        $todoId = $this->params()->fromQuery('todoId');
        $discussionService = new PmdiscussionService($this->getEntityManager());
        $discussions = $discussionService->getDiscussion($todoId);
        return new JsonModel(array('discussions' => $discussions));
    }

    public function create($data)
    {
        $discussionService = new PmdiscussionService($this->getEntityManager());
        $discussionId = $discussionService->saveDiscussion($data);
        return new JsonModel(array('discussionId' => $discussionId));
    }
}
