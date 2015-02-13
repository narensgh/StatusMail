<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Management\Controller;

/**
 * Description of TestHController
 *
 * @author narendra.singh
 */


use Management\Controller\BaseController;
use Zend\View\Model\ViewModel;

class TestbController extends BaseController
{
    public function IndexAction()
    {
        return new ViewModel();
    }
}
