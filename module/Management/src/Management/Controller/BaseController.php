<?php

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;


class BaseController extends AbstractActionController{

	protected $_em;
        protected $session;
	public function __construct()
        {
            $this->session = new Container('appl');
	}

	public function getEntityManager(){
		if(!$this->_em){
			$sm = $this->getServiceLocator();
			$this->_em = $sm->get('Doctrine\ORM\EntityManager');
		}
		return $this->_em;
	}
	public function redirectTo($route){
		return $this->redirect()->toRoute('base',$route);
	}

}