<?php

/**
 * Login Controller
 */

namespace Management\Controller;

use Management\Model\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Management\Form\LoginForm;
use Management\Form\SignUpForm;
use Management\Service\LoginService;
use Management\Service\AccessTokenService;
use Libs\SendMail;

class LoginController extends BaseController {
    /**
     * @var EntityManager
     */
// 	private $_em;

    /**
     * @var Container
     */
    private $_session;

    /**
     * @var User
     */
    private $_user;

    function __construct() {
        $this->_session = new Container('appl');
    }

    public function indexAction() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'u.firstName, u.lastName')
                ->add('from', 'Management\Model\Entity\User u')
                ->where('u.userId = :id')
                ->setParameter('id', $this->_session->userId);
        $result = $qb->getQuery()->getSingleResult();
        return new ViewModel(array('results' => $result));
    }

    public function loginAction() {
        $loginForm = new LoginForm();
        $signUpForm = new SignUpForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $post = $request->getPost();
            $serviceLogin = new LoginService($this->getEntityManager());

            if ($post['submit'] == "Login") {
                $result = $serviceLogin->login($post, $loginForm);
                $post['peopleId'] = $this->_session->userId;
                if ($result['action'] == 'index') {
                    $accessTokenService = new AccessTokenService($this->getEntityManager());
                    $accessTokenService->setAccessToken($post);
                }
                $this->redirectTo($result);
            } else if ($post['submit'] == "Sign Up") {
                $result = $serviceLogin->signUp($post, $signUpForm);
                if ($result['action'] == 'index')
                    $this->redirectTo($result);
            }
        }
        return new ViewModel(
                array(
            'loginForm' => $loginForm,
            'signUpForm' => $signUpForm
                )
        );
    }

    private function isLogedIn() {
        if (isset($this->_session->username) || $this->_session->afterLogout || isset($this->_session)) {
            return true;
        } else {
            $this->redirectTo(array('controller' => 'index', 'action' => 'login'));
        }
    }

    public function redirectTo($route) {
        return $this->redirect()->toRoute('base', $route);
    }

    public function logoutAction() {
//        unset($this->_session->username);
//        unset($this->_session->userId);
//        $this->_session->afterLogout = true;
        $this->_session->getManager()->getStorage()->clear('appl');
        $this->redirectTo(array('controller' => 'login', 'action' => 'login'));
    }
    public function forgotpasswordAction ()
    {
        $post = $this->getRequest()->getPost();
        if (!empty($post['email'])) {
            $serviceLogin = new LoginService(null);
            $response = $serviceLogin->resetPassword($this->getEntityManager(), $post['email']);
            if ($response) {
                $config = $this->getServiceLocator()->get('Config');
                $serviceLogin->sendNewPassword($config, $response);
                $this->redirectTo(array('controller' => 'login', 'action' => 'login'));
            } else {
               $this->redirectTo(array('controller' => 'login', 'action' => 'forgetpassword'));
            }
        }
    }

}
