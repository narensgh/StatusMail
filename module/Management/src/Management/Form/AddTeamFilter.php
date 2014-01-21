<?php
namespace Management\Form;

use Zend\InputFilter\InputFilter;

class AddTeamFilter extends InputFilter 
{
	public function __construct()
	{
		$this->add(array(
			'name'       => 'teamName',
			'required'   => true,
			'filters' => array(
				array(
					'name'    => 'StripTags',
				),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 5,
						'max'      => 25,
					),
				),
			),
		));
		$this->add(array(
			'name'       => 'teamAbbr',
			'required'   => true,
			'filters' => array(
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
						'max'      => 10,
					),
				),
			),
		));
	}
}

?>