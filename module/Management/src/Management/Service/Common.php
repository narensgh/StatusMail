<?php

namespace Management\Service;

use Zend\Session\Container;

class Common {

	protected $_em;
	protected $_session;

	public function __construct($em){
		$this->_em = $em;
		$this->_session = new Container('appl');
	}

	public function getEntityManager(){
		if($this->_em)
			return $this->_em;
	}
}