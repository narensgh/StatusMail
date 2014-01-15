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
// 		date('Y-m-d', strtotime("-7 days",strtotime(date('Y-m-d'))))
// 		echo date('Y-m-d'). " --------------- ". date('Y-m-d', strtotime("+1 days",strtotime(date('Y-m-d'))));exit;
		if (!$fromDate)
			$fromDate = date('Y-m-d', strtotime("-7 days",strtotime(date('Y-m-d'))));
		if (!$toDate)
			$toDate = date('Y-m-d', strtotime("+1 days",strtotime(date('Y-m-d'))));

		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->add('select', 's,t')
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

		return $reports;
	}

}