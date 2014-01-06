<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusController
 *
 * @author Narendra
 */

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Session\Container;

class StatusController extends AbstractActionController
{
    function __construct() 
    {
        $this->session = new Container('appl');
        $this->isLogedIn();
    }
    private function isLogedIn()
    {
        if($this->session->username)
        {
            $this->redirectTo(array('controller'=>'index','action'=>'login'));
        }
    }
    private function redirectTo($route)
    {
    	return $this->redirect()->toRoute('base',$route);
    }
}

?>
