<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Management\Model\Status;
use Zend\Session\Container;

class StatusService extends Common{

	public function __construct($em){
		parent::__construct($em);
	}

	public function getUserReport($userId, $fromDate=null, $toDate=null){
		if (!$fromDate)
			$fromDate = date('Y-m-d', strtotime("-14 days",strtotime(date('Y-m-d'))));
		if (!$toDate)
			$toDate = date('Y-m-d', strtotime("+1 days",strtotime(date('Y-m-d'))));

		$modelStatus = new Status($this->_em);
		$reports = $modelStatus->getUserReportData($userId, $fromDate, $toDate);
		$reports = json_decode(json_encode($reports, true));
		$reportArr = array();
		foreach ($reports as $report){
			$statusId = $report->statusId;
			$reportDate = date('Y-m-d',strtotime($report->dateAdded->date));
			$reportArr[$reportDate]->report->$statusId = array(
						'status' => $report->status,
						'description'=> $report->description,
						'jiraTicketId'=>$report->task->jiraTicketId,
						'title'=>$report->task->title,
						'reportDate'=> $reportDate
					);
			$reportArr[$reportDate]->userId = $report->user->userId;
			$reportArr[$reportDate]->name = $report->user->firstName." ".$report->user->lastName;
		}
		return json_decode(json_encode($reportArr, true));
	}

	public function getAllReports(){
		$statusModel = new Status($this->_em);
		$allReports = $statusModel->fetchAllReports();
	}

	public function saveStatus($postData){
		$user = $this->_em->find('Management\Model\Entity\User', $this->session->userId);
		$ticketType = $this->_em->find('Management\Model\Entity\Team', $postData->ticketType);
		$jiraTicket = $this->getJiraTicket($ticketType->getTeamAbbr()."-".$postData->ticketNumber, $postData);
		$status = new \Management\Model\Entity\Status();
		$status->setDescription($postData->description);
		$status->setUser($user);
		$status->setStatus($postData->status);
		$status->setTask($jiraTicket);

		$this->_em->persist($status);
		$this->_em->flush();
		$this->redirectTo(array('controller'=>'status','action'=>'report'));
	}

	public function getJiraTicket($ticketNum, $postData){
		$jiraTicket = $this->_em->getRepository('Management\Model\Entity\Task')->findOneByJiraTicketId($ticketNum);
		if (!$jiraTicket){
			$jiraTicket = new Task();
			$jiraTicket->setJiraTicketId($ticketNum);
			$jiraTicket->setTitle($postData->title);
		}
		return $jiraTicket;
	}
}