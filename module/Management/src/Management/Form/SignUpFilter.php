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
						'max'      => 140,
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
