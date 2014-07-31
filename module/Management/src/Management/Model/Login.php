<?php

namespace Management\Model;

use Zend\Validator\File\Md5;

use Management\Model\Entity\User;

class Login{

	protected $_em;

	public function __construct($em){
		$this->_em = $em;
	}

	public function isValidLoginData($post){
		$qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 'u')
			->add('from', 'Management\Model\Entity\User u')
			->where('u.username = ?1')
			->andwhere('u.password = ?2')
			->setParameter(1, $post['username'])
			->setParameter(2, md5($post['password']))
			->setMaxResults(1);
		$result = $qb->getQuery()->getOneOrNullResult();
		return $result;
	}

	public function createUser($data){
		$user = new User();
		$user->setPassword(md5($data->password));
		$user->setUsername($data->username);
		$user->setEmail($data->emailid);
		$user->setContactNo($data->contact);
		$user->setFirstName($data->firstName);
		$user->setLastName($data->lastName);
		$this->_em->persist($user);
		$this->_em->flush();
		return $user;
	}

}