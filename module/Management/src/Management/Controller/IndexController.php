<?php
/**
 * Index Controller
 * 
 */

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

use Zend\View\Model\ViewModel;

use Management\Model\User;

use Management\Form\LoginForm;
use Management\Form\SignUpForm;


class IndexController extends AbstractActionController
{
    private $em;
    private $session;
    function __construct() 
    {
        $this->session = new Container('appl');
        $this->isLogedIn();
    }

    public function indexAction()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'l')
           ->add('from', 'Management\Model\Entity\Login l');
        $result = $qb->getQuery()-> getArrayResult();
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

            $result = $qb->getQuery()->getArrayResult();
            if (!empty($result)) 
            {
                $this->session->username = $result['username'];
                $this->session->userId = $result['peopleId'];
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
    	$signUpForm->setInputFilter($this->user->getInputFilter());
    	$signUpForm->setData($post);
    	if ($signUpForm->isValid()) {
    		$this->user->exchangeArray($signUpForm->getData());
    		$this->getUserTable()->userSignUp($this->user);
    		$this->session->username = $this->user->username;
    		$this->redirectTo(array('controller'=>'index','action'=>'index'));
    	}    	 
    }
    private function isLogedIn()
    {
        if($this->session->username)
        {
            $this->redirectTo(array('controller'=>'index','action'=>'login'));
        }
    }
    public function logoutAction()
    {
    	$this->session->getManager()->getStorage()->clear('appl');
    	$this->redirectTo(array('controller'=>'index','action'=>'login'));
    }
    private function redirectTo($route)
    {
    	return $this->redirect()->toRoute('base',$route);
    }
}
