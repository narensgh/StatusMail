<?php

namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Zend\Session\Container;
use Libs\SendMail;

class LoginService extends Common {

    public function __construct($em) {
        parent::__construct($em);
    }

    public function login($post) {
        if (!empty($post)) {
            $modelLogin = new Login($this->_em);
            $userObj = $modelLogin->isValidLoginData($post);
            if (!empty($userObj)) {
                $this->_session->username = $userObj->getUserName();
                $this->_session->userId = $userObj->getUserId();
                $this->_session->firstName = $userObj->getFirstName();
                $this->_session->lastName = $userObj->getLastName();
                $this->_session->userType = $userObj->getUserType();
                $this->_session->afterLogout = false;
                return array('controller' => 'status', 'action' => 'index');
            } else
                return array('controller' => 'login', 'action' => 'login');
        } else
            return array('controller' => 'login', 'action' => 'login');
    }

    public function signUp($post, $signUpForm) {
        $signUpFilter = new SignUpFilter();
        $signUpForm->setInputFilter($signUpFilter);
        $signUpForm->setData($post);
        if ($signUpForm->isValid()) {
            $modelLogin = new Login($this->_em);
            $userObj = $modelLogin->createUser($post);
            if ($userObj) {
                $this->_session->username = $userObj->getUsername();
                $this->_session->userId = $userObj->getUserId();
                $this->_session->firstName = $userObj->getFirstName();
                $this->_session->lastName = $userObj->getLastName();
                $this->_session->userType = 3;
                $this->_session->afterLogout = false;
                return array('controller' => 'status', 'action' => 'index');
            } else
                return array('controller' => 'login', 'action' => 'login');
        }
    }
    public function resetPassword ($em, $email)
    {
        $modelLogin = new Login($em);
        $user = $modelLogin->findUserByEmail($email);
        if (!empty($user)) {
            $password = $this->generatePassword();
             $user = $modelLogin->resetPassword($user, $password);
             $user->setPassword($password);
             return $user;
        } else {
            return false;
        }
    }

    /**
     *
     * @return string $password
     */
    private function generatePassword()
    {
        $randomArray = array('N', 'A','R', 'E', 'N', 'S', 'G', 'H', 'n', 'a', 'r', 'e', 'n', 's', 'g', 'h', '2', '4', '6', '8');
        $randomKeys= array_rand($randomArray, 6);
        $password = "";
        foreach ($randomKeys as $keys){
            $password .= $randomArray[$keys];
        }
        return $password;
    }

    public function sendNewPassword ($config, $user)
    {
        $mailConfig = (object) $config['mailer'];
        $mailer = new SendMail();
        $mailer->setConfig($mailConfig);
        $recipient = new \stdClass();
        $recipient->toEmail = $user->getEmail();
        $recipient->toName  = $user->getFirstName()." ".$user->getLastName();
        $mailer->setRecipient(array ($recipient));
        $message = $this->setTemplate($user);
        $mailer->sendMail("Timesheet Account password changed", $message);
    }

    private function setTemplate($param)
    {
        $html = "<div style='background: #F5F5F5; border: 1px solid #10ADF5; font-family: verdana; font-size: 16px; '>"
            . "<div style=' background: #10adf5; color: #fefefe; font-weight: bold; padding: 10px;'> Your password has reset for: </div>"
            ."<div style='line-height: 24px; padding: 10px;'>"
            . "E-Mail ID : {$param->getEmail()}<br/>"
            . " Username : {$param->getUsername()}<br/>"
            . "New Password : {$param->getPassword()}</div>"
            . "</div>";
        return $html;
    }

}
