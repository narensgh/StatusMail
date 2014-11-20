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

use Application\Service\PmfieldService;

class PmfieldController extends BaseController
{
    public function get($id)
    {
        return new JsonModel(array('Method not allowed..!! : '. $id));
    }
    public function getList()
    {
        $pmfieldService = new PmfieldService($this->getEntityManager());
        $pmfields = $pmfieldService->getFields();
        return new JsonModel(array('pmfields' => $pmfields));
    }
}
