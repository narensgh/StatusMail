<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;

class LoginService extends Common{

	protected $_em;

	public function __construct($em){
		$this->_em = $em;
	}

	public function login($post){
		if (!empty($post)){
			$modelLogin = new Login($this->_em);
			$userObj = $modelLogin->isValidLoginData($post);
			if (!empty($userObj)){
				$this->session->username = $userObj->getUserName();
				$this->session->userId = $userObj->getLoginid();
				$this->session->userType = $userObj->getUserType();
				$this->redirectTo(array('controller' => 'status', 'action' => 'index'));
			} else
				$this->redirectTo(array('controller' => 'login', 'action' => 'login'));
		} else
			$this->redirectTo(array('controller' => 'login', 'action' => 'login'));
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
				$this->redirectTo(array('controller'=>'status','action'=>'index'));
			}
			echo "Something went wrong.";exit;
		}
	}

	private function redirectTo($route){
		return $this->redirect()->toRoute('base',$route);
	}

}



?>