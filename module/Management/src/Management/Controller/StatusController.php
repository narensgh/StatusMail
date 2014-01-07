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

use Management\Form\StatusForm;

use Zend\Session\Container;

class StatusController extends AbstractActionController
{
	private $session;
    function __construct()
    {
    	$this->session = new Container('appl');
        $this->isLogedIn();
    }

    public function indexAction()
    {
        $statusForm = new StatusForm();
        $this->isLogedIn();
        return new ViewModel(
            array(
                'statusForm'=>$statusForm,
            )
        );
    }

    private function isLogedIn()
    {
        if($this->session->username)
        {
            return true;
        }
        else {
        	$this->redirectTo(array('controller'=>'index','action'=>'login'));
        }
    }
    private function redirectTo($route)
    {
    	return $this->redirect()->toRoute('base',$route);
    }
}

?>
