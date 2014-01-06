<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
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
	protected $userTable;
	protected $user;
	public $session;
	protected $em;
	function __construct()
	{
		$this->user = new User();
		$this->session = new Container('appl');
	}
	public function getEntityManager(){
		if(!$this->em){
			$sm = $this->getServiceLocator();
			$this->em = $sm->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}
	
    public function indexAction()
    {
    	if(isset($this->session->username))
    	{
    		$date = date('Y-m-d', strtotime("-20 days", strtotime(date('Y-m-d'))));
    		echo $date ."  <br/>";
// 			$qb = $this->getEntityManager()->createQueryBuilder('SELECT u FROM Management\Model\Entity\Login u where u.lastactivity >"'. $date.'"');
// 			$qb->add('select', 'l')
// 			->add('from', '\Management\Model\Entity\Login  l')
// 			->where('l.lastactivity >= ?1')
// 			->setParameter(1, $date);
// 			$query = $qb->getQuery();
// 			$users = $query->getArrayResult();
	
    		$qb = $this->getEntityManager()->createQueryBuilder();
    		$qb->add('select', 'l, ui')
    		->add('from', 'Management\Model\Entity\Login l')
    		->innerJoin('l.Management\Model\Entity\UserInfo ui with ui.loginid = l.loginid');
    		
//     		->where('raq.status = ?1')
//     		->andWhere('r.releaseStatus = ?2')
//     		->setParameter(1, 'checked_in')
//     		->setParameter(2, $releaseStatus)
//     		->orderBy('raq.releaseApprovalId', 'DESC')
//     		->setMaxResults(1);
    		
    		$query = $qb->getQuery();
    		echo $query->getSql();die;
    		$users = $query->getArrayResult();
    		print_r($users);die;
					
	        return new ViewModel(array('users'=>json_decode(json_encode($users,true))));
    	}
    	else
    	{
    		$this->redirectTo(array('controller'=>'index','action'=>'login'));
    	}
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
    	$user = $this->getUserTable()->userSignIn($post);
    	$this->session->username = $user->username;
    	$this->redirectTo(array('controller'=>'index','action'=>'index')); 	
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
    public function getUserTable()
    {
    	if (!$this->userTable) {
    		$sm = $this->getServiceLocator();
    		$this->userTable = $sm->get('Management\Model\UserTable');
    	}
    	return $this->userTable;
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
