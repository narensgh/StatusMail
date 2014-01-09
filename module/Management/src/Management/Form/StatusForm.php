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

class StatusForm extends Form
{
    function __construct()
    {
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->add(array(
        		'type' => 'Select',
        		'name' => 'ticketType',
        		'attributes' =>  array(
        				'id' => 'ticketType',
        				'class' => 'select2',
        				'options' => array(
        						'' => 'Select Ticket Type',
        						'ASC' => 'ASC',
        						'LNC' =>'LNC',
        						'MOV' => 'MOV',
        						'VAPI' => 'VAPI'
        				),
        		),
        		'options' => array(
        				'label' => 'Ticket No',
        				'label_attributes' => array(
        						'class' => 'label1'
        				)
        		),
        ));
        $this->add(array(
                    'name' => 'ticketno',
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
        						'' => 'Select Status',
        						'Under Review' => 'Under Review',
        						'Work in progress' => 'Work in progress',
        						'Completed' => 'Completed'
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
