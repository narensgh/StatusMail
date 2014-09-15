<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

/**
 * Description of UserService
 *
 * @author narendra.singh
 */
use Application\Model\UserModel;

class UserService
{
    private $_em;

    /**
     *
     * @param type $em
     */

    function __construct($em)
    {
        if(empty($this->_em)){
            $this->_em = $em;
        }
    }

    public function getUserById($userId)
    {
        $userObject = new \stdClass();
        $userModel = new UserModel($this->_em);
        $user = $userModel->getUserById($userId);
        $userObject->userId = $user->getUserId();
        $userObject->firstName = $user->getFirstName();
        $userObject->lastName = $user->getLastName();
        $userObject->username = $user->getUsername();
        $userObject->contactNo = $user->getContactNo();
        $userObject->email = $user->getEmail();
        return $userObject;
    }
}
