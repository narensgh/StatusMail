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
use Management\Model\Entity\Login;
use Management\Model\Entity\UserInfo;
use Management\Form\LoginForm;
use Management\Form\SignUpForm;
use Management\Form\SignUpFilter;
use Management\Service\LoginService;

class LoginController extends AbstractActionController	{

	/**
	 * @var EntityManager
	 */
	private $em;

	/**
	 * @var Container
	 */
	private $session;

	/**
	 * @var User
	 */
	private $user;

	function __construct(){
		$this->session = new Container('appl');
		//$this->isLogedIn();
	}

	public function indexAction(){
// 		$qb = $this->getEntityManager()->createQueryBuilder();
// 		$qb->add('select', 'l')
// 		   ->add('from', 'Management\Model\Entity\Login l');
// 		$result = $qb->getQuery()-> getArrayResult();
// 		return new ViewModel(array('results' => $result));
	}

	public function getEntityManager(){
		if(!$this->em)
		{
			$sm = $this->getServiceLocator();
			$this->em = $sm->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}

	public function loginAction(){
		$loginForm = new LoginForm();
		$signUpForm = new SignUpForm();
		$request = $this->getRequest();

		if($request->isPost()){
			$post = $request->getPost();
			$serviceLogin = new LoginService();

			if( $post['submit'] == "Login"){
				$serviceLogin->login($post, $loginForm);exit;
				$this->login($post, $loginForm);
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
			$this->redirectTo(array('controller'=>'index','action'=>'login'));
		}
	}

	public function logoutAction(){
		unset($this->session->username);
		unset($this->session->userId);
		$this->session->afterLogout = true;
		$this->redirectTo(array('controller'=>'index','action'=>'login'));
	}

	private function redirectTo($route){
		return $this->redirect()->toRoute('base',$route);
	}
}
