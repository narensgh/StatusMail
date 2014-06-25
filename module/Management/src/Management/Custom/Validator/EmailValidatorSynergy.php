<?php

namespace Management\Custom\Validator;

use Zend\Validator\AbstractValidator;

class EmailValidatorSynergy extends AbstractValidator{
	const NOT_ENDS_WITH = 'not_ends_with';
	const INVALID_CHAR = 'invalid_characters';

	protected $messageTemplates = array(
		self::NOT_ENDS_WITH =>	"'%value%' is not a valid email-id. It should end with 'synergytechservices.com'.",
		self::INVALID_CHAR	=>	"'%value%' contains invalid characters. Only alphabets and period is allowed."
	);

	public function isValid($value){
		$this->setValue($value);

		if (!preg_match('/synergytechservices.com$/i', $value)){
			$this->error(self::NOT_ENDS_WITH);
			return false;
		}

		$username = explode('@', $value);
		if (!preg_match('/^[a-zA-Z.]+$/i', $username[0])){
			$this->error(self::INVALID_CHAR);
			return false;
		}

		return true;
	}

}