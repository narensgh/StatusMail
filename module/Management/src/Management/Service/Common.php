<?php

namespace Management\Service;

use Zend\Session\Container;

class Common {

	protected $_em;
	protected $_session;

	public function __construct($em){
		$this->_em = $em;
		$this->_session = new Container('appl');
	}

	public function getEntityManager(){
		if(!$this->_em)
			$this->_em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		return $this->_em;
	}

	protected function isLoggedIn(){
		if (isset($this->_session->user->username)){
			echo "A";
		}if ($this->_session->afterLogout){
			echo "B";
		}if (isset($this->_session)){
			echo "C";
		}

		if(isset($this->_session->user) || $this->_session->afterLogout || isset($this->_session)){
			return true;
		}else {
			$this->redirectTo(array('controller'=>'login','action'=>'login'));
		}

		// 		if (isset($this->_session->user)){
		// 			return true;
		// 		}else {
		// 			$this->redirectTo(array('controller'=>'login','action'=>'login'));
		// 		}
	}

// 	private function isLoggedIn(){
// 		if($this->_session->username)
// 			return true;
// 		else
// 			$this->redirectTo(array('controller'=>'login','action'=>'login'));
// 	}
}