<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Management\Controller;

/**
 * Description of ErrorController
 *
 * @author narendra.singh
 */
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class ErrorController extends AbstractActionController
{

    public function accessdeniedAction ()
    {
        return new ViewModel(array());
    }

}
