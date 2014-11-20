<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

/**
 * Description of PmfieldService
 *
 * @author narendra.singh
 */

use Application\Model\PmfieldModel;

class PmfieldService
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
    public function getFields($fieldId = null)
    {
        $pmfieldModel = new PmfieldModel($this->_em);
        $pmfields = $pmfieldModel->getFields($fieldId);
        return $pmfields;
    }

}
