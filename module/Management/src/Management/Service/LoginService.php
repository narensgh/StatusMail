<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Zend\Session\Container;

class LoginService extends Common{

	protected $_em;
	protected $session;

	public function __construct($em){
		$this->_em = $em;
		$this->session = new Container('appl');
	}

	public function login($post){
		if (!empty($post)){
			$modelLogin = new Login($this->_em);
			$userObj = $modelLogin->isValidLoginData($post);
			if (!empty($userObj)){
				$this->session->username = $userObj->getUserName();
				$this->session->userId = $userObj->getUserId();
				$this->session->firstName = $userObj->getFirstName();
				$this->session->lastName = $userObj->getLastName();
				return  array('controller' => 'status', 'action' => 'index');
			} else
				return array('controller' => 'login', 'action' => 'login');
		} else
			return array('controller' => 'login', 'action' => 'login');
	}

	public function signUp($post, $signUpForm){
		$signUpFilter = new SignUpFilter();
		$signUpForm->setInputFilter($signUpFilter);
		$signUpForm->setData($post);
		if ($signUpForm->isValid()) {
			$modelLogin = new Login($this->_em);
			$userObj = $modelLogin->createUser($post);
			if ($userObj){
				$this->session->username = $userObj->getUsername();
				$this->session->userId = $userObj->getUserId();
				$this->session->firstName = $userObj->getFirstName();
				$this->session->lastName = $userObj->getLastName();
				return array('controller'=>'status','action'=>'index');
			}else
				return array('controller' => 'login', 'action' => 'login');
		}
	}

}



?>