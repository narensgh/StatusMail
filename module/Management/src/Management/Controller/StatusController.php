<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusController
 *
 * @author Narendra
 */

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Management\Form\StatusForm;
use Management\Model\Entity\Report;
use Zend\Session\Container;

class StatusController extends AbstractActionController
{
	private $session;
	private $em;
    function __construct(){
    	$this->session = new Container('appl');
       // $this->isLogedIn();
    }

    public function indexAction()
    {
    	$this->isLogedIn();
        $statusForm = new StatusForm();
        $this->isLogedIn();
        return new ViewModel(
            array(
                'statusForm'=>$statusForm,
            )
        );
    }
	public function saveStatusAction()
	{
    	$this->isLogedIn();
		if($this->getRequest()->isPost())
		{
			$userInfo = $this->getEntityManager()->find('Management\Model\Entity\UserInfo', $this->session->userId);
// 			$statusForm = new StatusForm();
			$report = new Report();
			$post = $this->getRequest()->getPost();
			$report->setUserId($userInfo);
			$report->setTicketNo($post->ticketno);
			$report->setTitle($post->title);
			$report->setDescription($post->description);
			$report->setDateAdded(new \DateTime('now'));
			$this->getEntityManager()->persist($report);
			$this->getEntityManager()->flush();
			$this->redirectTo(array('controller'=>'status','action'=>'report'));
		}

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
    private function isLogedIn()
    {
        if($this->session->username)
        {
            return true;
        }
        else {
        	$this->redirectTo(array('controller'=>'index','action'=>'login'));
        }
    }
    public function reportAction()
    {
    	$this->isLogedIn();
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	$qb->add('select', 'r')
    	->add('from', 'Management\Model\Entity\Report r')
		 ->innerJoin('r.userId', 'ui')
		 ->where('r.userId = :userId')
         ->setParameter('userId', $this->session->userId);
    	$reports = $qb->getQuery()-> getArrayResult();
    	return new ViewModel(array('reports' => json_decode(json_encode($reports, true))));
    }
    private function redirectTo($route)
    {
    	return $this->redirect()->toRoute('base',$route);
    }
}

?>
