<?php

namespace Management\Model;

class Base {

	protected $_em;

	public function __construct(){
		$this->_em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}

	public function getEntityManager(){
		if(!$this->_em)
			$this->_em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		return $this->_em;
	}

}