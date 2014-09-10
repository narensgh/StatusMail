<?php
namespace Management\view\Helper;

use Zend\Session\Container;

use Zend\View\Helper\AbstractHelper;

class MenuHelper extends AbstractHelper 
{
	private $_session;
	
	function __construct(){
		$this->_session = new Container();	
	}
	public function topMenu()
	{
		$topMenu = Array();
		$topMenu = array(
				'New Report' 	=>	'status/index',
				'View Report'	=>	'status/report'
			);
		return $topMenu;
	}
}

?>