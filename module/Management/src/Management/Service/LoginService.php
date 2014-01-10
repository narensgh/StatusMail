<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;

class LoginService extends Common{

	public function login($post){
		if (!empty($post)){
			$modelLogin = new Login();
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
			$modelLogin = new Login();
			$userObj = $modelLogin->createUser($post);echo "<pre>";print_r($userObj);exit;
			if ($userObj){
				$this->session->username = $userObj->
				$this->redirectTo(array('controller'=>'status','action'=>'index'));
			}
			echo "Something went wrong.";exit;
		}
	}

}



?>