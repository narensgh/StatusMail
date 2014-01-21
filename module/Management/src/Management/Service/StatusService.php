<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Zend\Session\Container;

class StatusService extends Common{

	protected $_em;
	protected $session;

	public function __construct($em){
		$this->_em = $em;
		$this->session = new Container('appl');
	}

	public function getUserReport($userId, $fromDate=null, $toDate=null){
		if (!$fromDate)
			$fromDate = date('Y-m-d', strtotime("-7 days",strtotime(date('Y-m-d'))));
		if (!$toDate)
			$toDate = date('Y-m-d', strtotime("+1 days",strtotime(date('Y-m-d'))));

		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->add('select', 's,t,u')
		->add('from', 'Management\Model\Entity\Status s')
		->innerJoin('s.task', 't')
		->innerJoin('s.user', 'u')
		->where('u.userId = :userId')
		->andWhere('s.dateAdded BETWEEN :from AND :to')
		->setParameter('userId', $userId)
		->setParameter('from', $fromDate)
		->setParameter('to', $toDate)
		->orderBy('s.dateAdded');
		$reports = $qb->getQuery()->getArrayResult();
		$reports = json_decode(json_encode($reports, true));
		$reportArr = array();
		foreach ($reports as $report)
		{
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

}