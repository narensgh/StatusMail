<?php

namespace Management\Model;

use Management\Model\Entity\User;

class Login extends Base{

	public function isValidLoginData($post){
		$qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 'u')
			->add('from', 'Management\Model\Entity\User u')
			->where('u.username = ?1')
			->andwhere('u.password = ?2')
			->setParameter(1, $post['username'])
			->setParameter(2, md5($post['password']));

		$result = $qb->getQuery()->getSingleResult();echo "<pre>";print_r($result);exit;
		return $result;
	}

	public function createUser($data){
		$user = new User();
		$user->setPassword($data->password);
		$user->setUsername($data->username);
		$user->setEmail($data->emailid);
		$user->setContactNo($data->contact);
		$user->setFirstName($data->firstName);
		$user->setLastName($data->lastName);

// 		$this->getEntityManager()->persist($user);
// 		$this->getEntityManager()->flush();
// 		$user = new UserInfo();
// 		$user->setEmailId($data->emailid);
// 		$user->setFullname($data->fullname);
// 		$user->setLogin($login);
		$this->getEntityManager()->persist($user);
		$this->getEntityManager()->flush();
// 		$this->user = $user;
		return $user;
	}

}