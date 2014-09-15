<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

/**
 * Description of UserModel
 *
 * @author narendra.singh
 */

class UserModel
{
     private $_em;
    /**
     *
     * @param ORMObject $em
     */
    function __construct($em)
    {
        if(empty($this->_em)){
            $this->_em = $em;
        }
    }

    public function getUserById($userId)
    {
        try {
             $user = $this->_em->getRepository('Application\Model\Entity\User')->findOneByUserId(array('userId'=> $userId));
             return $user;
        } catch (Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}
