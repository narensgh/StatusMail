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

    public function getUserById ($userId)
    {
        $userModel = new UserModel($this->_em);
        $user = $userModel->getUserById($userId);
        $userObject = $this->processUser($user);
        return $userObject;
    }

    protected function processUser ($user)
    {
        $userObject = new \stdClass();
        if(!empty($user)){
            $userObject->userId = $user->getUserId();
            $userObject->firstName = $user->getFirstName();
            $userObject->lastName = $user->getLastName();
            $userObject->username = $user->getUsername();
            $userObject->contactNo = $user->getContactNo();
            $userObject->email = $user->getEmail();
        }
        return $userObject;
    }

    public function getUserByIdAndPassword($userId, $password)
    {
        $userModel = new UserModel($this->_em);
        $user = $userModel->getUserByIdAndPassword($userId, $password);
        $userObject = $this->processUser($user);
        return $userObject;
    }

    public function getAllUser()
    {
        $users = array();
        $allUsers = $this->_em->getRepository('Application\Model\Entity\User')->findAll();
        foreach ($allUsers as $user) {
            $users[] = (array) $this->processUser($user);
        }
        return $users;
    }
}
