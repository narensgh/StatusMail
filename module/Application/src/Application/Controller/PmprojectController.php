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

use Application\Service\PmprojectService;

class PmprojectController extends BaseController
{
    
    function __construct ()
    {
        $this->setIdentifierName("projectId");
    }
    
    public function get($projectId)
    {
        $PmprojectService = new PmprojectService($this->getEntityManager());
        $pmproject = $PmprojectService->getProject($projectId);
        return new JsonModel(array('projects' => $pmproject));
    }
    public function getList()
    {
        $PmprojectService = new PmprojectService($this->getEntityManager());
        $pmproject = $PmprojectService->getProject();
        return new JsonModel(array('projects' => $pmproject));
    }
    public function create($data)
    {
        $PmprojectService = new PmprojectService($this->getEntityManager());
        $pmProjectId = $PmprojectService->saveProject($data);
        return new JsonModel(array('pmProjectId' => $pmProjectId));
    }
}
