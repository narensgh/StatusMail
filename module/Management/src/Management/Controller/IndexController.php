<?php
/**
 * Index Controller
 *
 */

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Management\Model\Entity\Login;
use Management\Model\Entity\UserInfo;
use Management\Form\LoginForm;
use Management\Form\SignUpForm;
use Management\Form\SignUpFilter;

class IndexController extends AbstractActionController
{
    private $em;
    private $session;
    function __construct()
    {
        $this->session = new Container('appl');
        //$this->isLogedIn();
    }

    public function indexAction()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'ui, l')
           ->add('from', 'Management\Model\Entity\UserInfo ui')
           ->innerJoin('ui.loginid', 'l')
           ->where('l.loginid = :id')
           ->setParameter('id', $this->session->userId);
        $result = $qb->getQuery()-> getSingleResult();
        return new ViewModel(array('results' => $result));
    }
    public function getEntityManager()
    {
        if(!$this->em)
        {
            $sm = $this->getServiceLocator();
            $this->em = $sm->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function loginAction()
    {
    	$loginForm = new LoginForm();
    	$signUpForm = new SignUpForm();
    	$request = $this->getRequest();
    	if($request->isPost()){
    		$post = $request->getPost();
	    	if( $post['submit'] == "Login"){
	    		$this->login($post, $loginForm);
	    	}else if($post['submit']=="Sign Up"){
	    		$this->signUp($post, $signUpForm);
	    	}
    	}
    	return new ViewModel(
    			array(
    				'loginForm'=>$loginForm,
    				'signUpForm'=>$signUpForm
    				)
    			);
    }
    private function login($post)
    {
        if (!empty($post))
        {
            $qb = $this->getEntityManager()->createQueryBuilder();
            $qb->add('select', 'l')
                    ->add('from', 'Management\Model\Entity\Login l')
                    ->where('l.username = ?1')
                    ->andwhere('l.password = ?2')
                    ->setParameter(1, $post['username'])
                    ->setParameter(2, md5($post['password']));

            $result = $qb->getQuery()->getSingleResult();
            if (!empty($result))
            {
                $this->session->username = $result->getUserName();
                $this->session->userId = $result->getLoginid();
                $this->redirectTo(array('controller' => 'status', 'action' => 'index'));
            } else {
                $this->redirectTo(array('controller' => 'index', 'action' => 'login'));
            }
        } else {
            $this->redirectTo(array('controller' => 'index', 'action' => 'login'));
        }
    }
    private function signUp($post, $signUpForm)
    {
    	$signUpFilter = new SignUpFilter();
    	$signUpForm->setInputFilter($signUpFilter);
    	$signUpForm->setData($post);
    	if ($signUpForm->isValid()) {
    		$this->createUser($post);
    		$this->session->username = $this->user->username;
    		$this->redirectTo(array('controller'=>'status','action'=>'index'));
    	}
    }

    private function createUser($data){
    	$login = new Login();
    	$login->setPassword($data->password);
    	$login->setUsername($data->username);
    	$this->getEntityManager()->persist($login);
    	$this->getEntityManager()->flush();
    	$user = new UserInfo();
    	$user->setEmailId($data->emailid);
    	$user->setContactNo($data->contact);
    	$user->setFullname($data->fullname);
    	$user->setLoginid($login);
    	$this->getEntityManager()->persist($user);
    	$this->getEntityManager()->flush();
		return true;
    }

    private function isLogedIn()
    {
        if(isset($this->session->username) || $this->session->afterLogout || isset($this->session))
        {
            return true;
        }else {
        	$this->redirectTo(array('controller'=>'index','action'=>'login'));
        }
    }
    public function logoutAction()
    {
    	unset($this->session->username);
    	unset($this->session->userId);
    	$this->session->afterLogout = true;
    	$this->redirectTo(array('controller'=>'index','action'=>'login'));
    }
    private function redirectTo($route)
    {
    	return $this->redirect()->toRoute('base',$route);
    }
}
