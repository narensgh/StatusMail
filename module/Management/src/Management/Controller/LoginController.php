<?php

/**
 * Login Controller
 */

namespace Management\Controller;

use Management\Model\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Management\Model\Entity\UserInfo;
use Management\Form\LoginForm;
use Management\Form\SignUpForm;
use Management\Form\SignUpFilter;
use Management\Service\LoginService;

class LoginController extends BaseController	{

	/**
	 * @var EntityManager
	 */
// 	private $_em;

	/**
	 * @var Container
	 */
	private $_session;

	/**
	 * @var User
	 */
	private $_user;

	function __construct(){
		$this->_session = new Container('appl');
		//$this->isLogedIn();
	}

// 	public function getEntityManager(){
// 		if(!$this->_em){
// 			$sm = $this->getServiceLocator();
// 			$this->_em = $sm->get('Doctrine\ORM\EntityManager');
// 		}
// 		return $this->_em;
// 	}

	public function indexAction(){
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->add('select', 'u.firstName, u.lastName')
		   ->add('from', 'Management\Model\Entity\User u')
		   ->where('u.userId = :id')
		   ->setParameter('id', $this->_session->userId);
		$result = $qb->getQuery()-> getSingleResult();
		return new ViewModel(array('results' => $result));
	}

	public function loginAction(){
		$loginForm = new LoginForm();
		$signUpForm = new SignUpForm();
		$request = $this->getRequest();

		if($request->isPost()){
			$post = $request->getPost();
			$serviceLogin = new LoginService($this->getEntityManager());

			if( $post['submit'] == "Login"){
				$result = $serviceLogin->login($post, $loginForm);
				$this->redirectTo($result);
			}else if($post['submit']=="Sign Up"){
				$serviceLogin->signUp($post, $signUpForm);
			}
		}
		return new ViewModel(
			array(
				'loginForm'=>$loginForm,
				'signUpForm'=>$signUpForm
			)
		);
	}


	private function isLogedIn(){
		if(isset($this->session->username) || $this->session->afterLogout || isset($this->session)){
			return true;
		}else {
			$this->redirectTo(array('controller'=>'login','action'=>'login'));
		}
	}

	public function logoutAction(){
		unset($this->session->username);
		unset($this->session->userId);
		$this->session->afterLogout = true;
		$this->redirectTo(array('controller'=>'login','action'=>'login'));
	}

	private function redirectTo($route){
		return $this->redirect()->toRoute('base',$route);
	}
}
