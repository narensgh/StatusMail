<?php
namespace Management\Form;

use Zend\InputFilter\InputFilter;

class SignUpFilter extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name'       => 'emailid',
			'required'   => true,
			'validators' => array(
				array(
					'name'    => 'EmailAddress',
					'options' => array(
						'domain' => true,
					),
				),

				array(
					'name'	=>	'Management\Custom\Validator\EmailValidatorSynergy'
				),
			),
		));

		$this->add(array(
			'name'       => 'firstName',
			'required'   => true,
			'filters'    => array(
				array(
					'name'    => 'StripTags',
				),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 2,
						'max'      => 20,
						'messages' => array(
							\Zend\Validator\StringLength::TOO_SHORT => 'First name cannot be less than 2 characters',
							\Zend\Validator\StringLength::TOO_LONG => 'First name cannot be more than 20 characters',
						),
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'lastName',
			'required'   => true,
			'filters'    => array(
				array(
					'name'    => 'StripTags',
				),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 2,
						'max'      => 140,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'username',
			'required'   => true,
			'filters'    => array(
				array(
					'name'    => 'StripTags',
				),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 2,
						'max'      => 140,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'contact',
			'required'   => true,
			'filters'    => array(
				array(
					'name'    => 'StripTags',
				),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 10,
						'max'      => 11,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'password',
			'required'   => true,
		));

	}
}
