<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Zend\Session\Container;

class LoginService extends Common{

	public function __construct($em){
		parent::__construct($em);
	}

	public function login($post){
		if (!empty($post)){
			$modelLogin = new Login($this->_em);
			$userObj = $modelLogin->isValidLoginData($post);
			if (!empty($userObj)){
				$this->_session->username = $userObj->getUserName();
				$this->_session->userId = $userObj->getUserId();
				$this->_session->firstName = $userObj->getFirstName();
				$this->_session->lastName = $userObj->getLastName();
				$this->_session->userType = $userObj->getUserType();
				$this->_session->afterLogout = false;
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
				$this->_session->username = $userObj->getUsername();
				$this->_session->userId = $userObj->getUserId();
				$this->_session->firstName = $userObj->getFirstName();
				$this->_session->lastName = $userObj->getLastName();
				$this->_session->userType = 1;
				$this->_session->afterLogout = false;
				return array('controller'=>'status','action'=>'index');
			}else
				return array('controller' => 'login', 'action' => 'login');
		}
	}

}



?>