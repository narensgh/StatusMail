<?php
namespace Management\Form;

use Zend\Form\Form;

class SignUpForm extends Form
{
	function __construct()
	{
		parent::__construct();
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'fullname',
				'type' => 'Text',
				'attributes' =>array(
						'class' => 'textbox'
				),
				'options' => array(
						'label' => 'Fullname',
						'label_attributes' => array(
								'class' => 'label1'
						),
				),
		));
		$this->add(array(
				'name' => 'emailid',
				'type' => 'Text',
				'attributes' =>array(
						'class' => 'textbox'
				),
				'options' => array(
						'label' => 'Email-Id',
						'label_attributes' => array(
								'class' => 'label1'
						),
				),
		));
		$this->add(array(
				'name' => 'username',
				'type' => 'Text',
				'attributes' =>array(
						'class' => 'textbox'
				),
				'options' => array(
						'label' => 'Username',
						'label_attributes' => array(
								'class' => 'label1'
						),
				),
		));
		$this->add(array(
				'name' => 'password',
				'type' => 'Text',
				'attributes' =>array(
						'class' => 'textbox'
				),
				'options' => array(
						'label' => 'password',
						'label_attributes' => array(
								'class' => 'label1'
						),
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Sign Up',
						'id' => 'submitbutton',
				),
		));
	}
}

?>