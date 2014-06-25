<?php
namespace Management\Form;
use Zend\Form\Form;

class AddTeamForm extends Form
{
	public function __construct()
	{
		parent::__construct();
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'teamName',
				'type' => 'Text',
				'attributes' =>array(
						'id' => 'teamName',
						'class' => 'textbox'
					),
				'options' => array(
						'label' => 'Team Name',
						'label_attributes' => array(
								'class' => 'label2'
						),
					),
			));
		$this->add(array(
				'name' => 'teamAbbr',
				'type' => 'Text',
				'attributes' =>array(
						'id' => 'teamAbbr',
						'class' => 'textbox'
				),
				'options' => array(
						'label' => 'Team Abbreviation',
						'label_attributes' => array(
								'class' => 'label2'
						)
					),
			));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'ADD',
						'id' => 'submitbutton',
						'class' => 'sign-in'
				),
			));
	}

}

?>