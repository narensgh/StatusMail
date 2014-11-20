<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;


class BaseController extends AbstractRestfulController{

	protected $_em;

	public function __construct(){
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