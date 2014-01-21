<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusForm
 *
 * @author Narendra
 */
namespace Management\Form;
use Zend\Form\Form;
use Management\Service\AdminService;

class StatusForm extends Form
{
    function __construct($em)
    {
        parent::__construct();
        $adminService = new AdminService($em);
        $this->setAttribute('method', 'post');
        $this->add(array(
        		'type' => 'Select',
        		'name' => 'ticketType',
        		'attributes' =>  array(
        			'id' => 'ticketType',
        			'class' => 'select3'        			
        		),
        		'options' => array(
        				'label' => 'Ticket No',
        				'label_attributes' => array(
        						'class' => 'label1'
        				),
        				'value_options' => $adminService->getTeamDropdown(),
        				'empty_option'  => 'Choose Team',
        		),
        ));
        $this->add(array(
                    'name' => 'ticketNumber',
                    'type' => 'Text',
                    'attributes' =>array(
                    	'id' => 'ticketno',
                        'class' => 'textbox'
                        ),
                    'options' => array(

                    		'label_attributes' => array(
                    				'class' => 'label1'
                    		)
                        ),
                    )
                );
        $this->add(array(
                    'name' => 'title',
                    'type' => 'Text',
                    'attributes' =>array(
                    	'id' => 'title',
                        'class' => 'textbox',
                    	'width' => '200'
                    ),
                    'options' => array(
                        'label' => 'Title',
                        'label_attributes' => array(
                            'class' => 'label1'
                        )
                   ),
                )
            );
        $this->add(array(
        		'type' => 'Select',
        		'name' => 'status',
        		'attributes' =>  array(
        				'id' => 'status',
        				'class' => 'select1',
        				'options' => array(
        						'' => '---Select Status---',
								'Committed'	=>	'Committed',
		        				'Completed'	=>	'Completed',
								'Under Review'	=>	'Under Review',
        						'Work in progress'	=>	'Work in progress',
        				),
        		),
        		'options' => array(
        				'label' => 'Status',
        				'label_attributes' => array(
        						'class' => 'label1'
        				)
        		),
        ));
        $this->add(array(
                    'name' => 'description',
                    'type' => 'Textarea',
                    'attributes' =>array(
                    	'id' => 'description',
                        'class' => 'editor'
                    ),
                    'options' => array(
                        'label' => 'Description',
                        'label_attributes' => array(
                            'class' => 'label1'
                        )
                   ),
                )
            );
        $this->add(array(
                'name' => 'submit',
                'type' => 'Submit',
                'attributes' => array(
                    'value' => 'Save',
                    'id' => 'submitbutton',
                	'class' =>'sign-in'
                ),
            )
        );
    }
}

?>
