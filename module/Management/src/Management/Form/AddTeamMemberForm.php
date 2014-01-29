<?php
namespace Management\Form;
use Zend\Form\Form;
use Management\Service\AdminService;

class AddTeamMemberForm extends Form
{
	public function __construct($em)
	{
		parent::__construct();
		$adminService = new AdminService($em);
		
		$this->setAttribute('method', 'post');
		$this->add(array(
			'type' => 'Select',
			'name' => 'Team',
			'attributes' =>  array(
				'id' => 'Team',
				'class' => 'select3',
			),
			'options' => array(
				'label' => 'Team',
				'label_attributes' => array(
					'class' => 'label2'
				),
				'value_options' => $adminService->getTeamDropdown(),
				'empty_option'  => 'Choose Team'
			),
		));
		$this->add(array(
			'type' => 'select',
			'name' => 'TeamMember',
			'attributes' =>  array(
				'id' => 'TeamMember',
				'class' => 'select1',
				'size'=>'10',
				'multiple'=>true,
			),
		));
		$this->add(array(
			'type' => 'select',
			'name' => 'SelectedTeamMember',
			'attributes' =>  array(
				'id' => 'SelectedTeamMember',
				'class' => 'select1',
				'multiple'=>true,
				'size'=>'10',

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