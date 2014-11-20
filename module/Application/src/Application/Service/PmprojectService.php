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

use Application\Model\PmprojectModel;

class PmprojectService
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

    /**
     *
     * @param int $fieldId
     * @return mixed $pmfields
     */
    public function getProject($projectId = null)
    {
        $pmprojectModel = new PmprojectModel($this->_em);
        $pmprojects = $pmprojectModel->getProject($projectId);
        return $pmprojects;
    }

    public function saveProject($data)
    {
        $pmprojectModel = new PmprojectModel($this->_em);
        $pmprojectId = $pmprojectModel->saveProject($data);
        return $pmprojectId;
    }

}
