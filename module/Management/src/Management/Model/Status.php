<?php

namespace Management\Model;

use Management\Model\Entity\User;

class Status{

	protected $_em;

	public function __construct($em){
		$this->_em = $em;
	}

	public function getUserReportData($userId, $fromDate=null, $toDate=null){
		$qb = $this->_em->createQueryBuilder();
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
		return $qb->getQuery()->getArrayResult();
	}

	public function fetchAllReports(){
		$qb = $this->_em->createQueryBuilder();
		$qb->add('select', 's,t,u')
			->add('from', 'Management\Model\Entity\Status s')
			->innerJoin('s.task', 't')
			->innerJoin('s.user', 'u');
		return $qb->getQuery()->getArrayResult();
	}

	public function fetchAllUsers(){
		$qb = $this->_em->createQueryBuilder();
		$qb->add('select', 'u')
		   ->add('from', 'Management\Model\Entity\User u');
		return $qb->getQuery()->getArrayResult();
	}

}