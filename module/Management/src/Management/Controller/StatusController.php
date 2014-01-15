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

use ZendTest\View\Helper\Placeholder\StandaloneContainerTest;

use Management\Service\StatusService;

use Management\Model\Entity\Status;

use Management\Model\Entity\Task;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Management\Form\StatusForm;
use Management\Model\Entity\Report;
use Zend\Session\Container;

class StatusController extends BaseController{

	private $session;
// 	private $em;

    function __construct(){
    	$this->session = new Container('appl');
       // $this->isLoggedIn();
    }

    public function indexAction(){
    	$this->isLoggedIn();
        $statusForm = new StatusForm();

        if ($this->getRequest()->isPost()){
        	$post = $this->getRequest()->getPost();
        	$statusForm->setData($post);
        	if ($statusForm->isValid()){
        		if($post['submit'] == 'Save'){
        			$this->saveStatus($post);
        		}
        	}
        }
        $this->isLoggedIn();
        return new ViewModel(array('statusForm'=>$statusForm));
    }

	public function saveStatus($postData){
    	$this->isLoggedIn();
		$user = $this->getEntityManager()->find('Management\Model\Entity\User', $this->session->userId);
// 		$statusForm = new StatusForm();

// 		echo "<pre>";print_r($postData);exit;

		$jiraTicket = $this->getJiraTicket($postData->ticketType."-".$postData->ticketNumber, $postData);
		$status = new Status();
		$status->setDescription($postData->description);
		$status->setUser($user);
		$status->setStatus($postData->status);
		$status->setTask($jiraTicket);

		$this->getEntityManager()->persist($status);
		$this->_em->flush();

// 		$report->setUserId();
// 		$report->setTicketNo($postData->ticketNumber);
// 		$report->setTitle($postData->title);
// 		$report->setDescription($postData->description);
// 		$report->setDateAdded(new \DateTime('now'));
// 		$this->getEntityManager()->persist($report);
		$this->redirectTo(array('controller'=>'status','action'=>'report'));
	}

	public function getJiraTicket($ticketNum, $postData){
		$jiraTicket = $this->getEntityManager()->getRepository('Management\Model\Entity\Task')->findOneByJiraTicketId($ticketNum);
		if (!$jiraTicket){
			$jiraTicket = new Task();
			$jiraTicket->setJiraTicketId($ticketNum);
			$jiraTicket->setTitle($postData->title);
		}
		return $jiraTicket;
	}

// 	public function getEntityManager()
// 	{
// 		if(!$this->em)
// 		{
// 			$sm = $this->getServiceLocator();
// 			$this->em = $sm->get('Doctrine\ORM\EntityManager');
// 		}
// 		return $this->em;
// 	}

    private function isLoggedIn(){
        if($this->session->username){
            return true;
        }
        else {
        	$this->redirectTo(array('controller'=>'login','action'=>'login'));
        }
    }

    public function freportAction(){
    	$this->isLoggedIn();
    	$qb = $this->getEntityManager()->createQueryBuilder();
//     	$qb->add('select', 's,t,u')
//     	->add('from', 'Management\Model\Entity\Task t')
// 		 ->innerJoin('t.status', 's')
// 		 ->innerJoin('s.user', 'u')
// 		 ->where('u.userId = :userId')
//          ->setParameter('userId', $this->session->userId)
//          ->orderBy('s.dateAdded');

    	$qb->add('select', 's,t')
    	->add('from', 'Management\Model\Entity\Status s')
    	->innerJoin('s.task', 't')
    	->innerJoin('s.user', 'u')
    	->where('u.userId = :userId')
    	->setParameter('userId', $this->session->userId)
    	->orderBy('s.dateAdded');

    	$reports = $qb->getQuery()->getArrayResult();
//     	echo "<pre>";print_r($reports);exit;
//     	return new ViewModel(array('reports' => json_decode(json_encode($reports, true))));
    	return new ViewModel(array('reports' => $reports));
    }

    public function reportAction(){
    	$this->isLoggedIn();
    	$serviceStatus = new StatusService($this->getEntityManager());
    	$userReport = $serviceStatus->getUserReport($this->session->userId);echo "<pre>";print_r($userReport);exit;
    	return new ViewModel(array('reports' => $userReport));
    }

    private function redirectTo($route){
    	return $this->redirect()->toRoute('base',$route);
    }

    public function viewAllReportAction(){
    	$this->isLoggedIn();
    	$serviceStatus = new StatusService($this->getEntityManager());
    	$userReport = $serviceStatus->getUserReport($this->session->userId);
    	return new ViewModel(array('reports' => $userReport));
    }

}

?>
