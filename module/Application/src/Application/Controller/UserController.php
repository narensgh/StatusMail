<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

/**
 * Description of UserController
 *
 * @author narendra.singh
 */

use Application\Controller\BaseController;
use Zend\View\Model\JsonModel;

use Application\Service\UserService;

class UserController extends BaseController
{
    function __construct ()
    {
        $this->setIdentifierName("userId");
    }

    public function get($userId)
    {
        $userService = new UserService($this->getEntityManager());
        $password = $this->params()->fromQuery('password');
        if (isset($password)) {
            $user = $userService->getUserByIdAndPassword($userId, $password);
        } else {
            $user = $userService->getUserById($userId);
        }
        return new JsonModel(array($user));
    }
    public function getList()
    {
        $userService = new UserService($this->getEntityManager());
        $users = $userService->getAllUser();
        return new JsonModel($users);
    }

    public function update($userId, $data)
    {
        return new JsonModel(array(
            $userId, $data
        ));
    }
}
