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
                    'name' => 'ticketno',
                    'type' => 'Text',
                    'attributes' =>array(
                        'class' => 'textbox'
                        ),
                    'options' => array(
                        'label' => 'Ticket No',
                        'label_attributes' => array(
                            'class' => 'label1'
                            ),
                        ),
                    )
                );
        $this->add(array(
                    'name' => 'title',
                    'type' => 'Text',
                    'attributes' =>array(
                        'class' => 'textbox'
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
                    'name' => 'description',
                    'type' => 'Text',
                    'attributes' =>array(
                        'class' => 'textbox'
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
                ),
            )
        );
    }
}

?>
