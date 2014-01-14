<?php
namespace Management\Form\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\ValidatorPluginManagerAwareInterface;

class EmailValidator extends AbstractValidator implements ValidatorPluginManagerAwareInterface
{
	protected $pluginManager;
	
	/**
	 * @var array
	 */
	protected $messageTemplates = array(
			  self::INVALID => "Invalid Email Domain ",
			);
	
	/**
	* @var array
	*/
	protected $messageVariables = array();
	
	
	public function setValidatorPluginManager(ValidatorPluginManager $pluginManager){
		$this->pluginManager = $pluginManager;
	}
	
	/**
	* Get validator plugin manager
	*
	* @return ValidatorPluginManager
	*/
	public function getValidatorPluginManager(){
		return $this->pluginManager;
	}
}

?>