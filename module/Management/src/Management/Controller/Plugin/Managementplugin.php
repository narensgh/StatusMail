<?php

namespace Management\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager,
    Zend\Session\Container as SessionContainer,
    Zend\Permissions\Acl\Acl;
use Management\Service\ServiceAcl;
use Libs\AccessControl;

class Managementplugin extends AbstractPlugin
{

    protected $sesscontainer;

    private function getSessContainer ()
    {
        if (!$this->sesscontainer) {
            $this->sesscontainer = new SessionContainer('appl');
        }
        return $this->sesscontainer;
    }
    function setUpSession ()
    {
        $config = array (
            'cookie_domain' => 'dev.project-management.com',
            'cookie_httponly' => true,
            'use_cookies' => true,
            'remember_me_seconds' => 30,
            'cookie_lifetime' => 30,
            'name' => 'project-management',
            'cookie_path' => '/manage'
        );

        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config);
        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();

        Container::setDefaultManager($sessionManager, null, null);
//        Container::getDefaultManager()->rememberMe(30);
    }
    public function doAuthorization ($event)
    {
        $targetEvent = $this->getControllerAction($event);
        $actionAllowed = array ('login', 'forgotpassword');
        $resource = array ('controller' => 'login', 'action' => 'login');
        if (!(($targetEvent->controller == 'login') && (in_array($targetEvent->action, $actionAllowed)))) {
            if (!(isset($this->getSessContainer()->username) && isset($this->getSessContainer()->userId))) {
                $this->setRedirect($event, $resource);
            }else{
                if($targetEvent->controller != 'pm'){
                   // $this->checkPrivilege($event);
                }
            }
        }
    }

    public function getUserMenu()
    {
        $userMenu = array();
        if(!empty($this->getSessContainer()->userMenu)) {
            $userMenu = json_decode($this->getSessContainer()->userMenu);
        }
       return $userMenu;
    }

    public function setUserMenu ($rolePermissions)
    {
        $userMenu = array ();
        foreach ($rolePermissions as $rolePermission) {
            $permission = $rolePermission->getPermission();
            $resource = $permission->getResource()->getModule();
            $roleId = $rolePermission->getRole()->getRoleId();
            if ($roleId == $this->getSessContainer()->userType) {
                $userMenu[$resource][$permission->getResource()->getResourceName()][$permission->getPrivilege()->getPrivilegeName()] = $permission->getPrivilege()->getDescription();
            }
        }
        $this->getSessContainer()->userMenu =  (!empty($userMenu)) ? json_encode($userMenu): "";
    }

    public function getControllerAction ($event)
    {
        $targetEvent = new \stdClass();
        $controller = $event->getTarget();
        $controllerClass = get_class($controller);
        $targetEvent->module = strtolower(substr($controllerClass, 0, strpos($controllerClass, '\\')));
        $routeMatch = $event->getRouteMatch();
        $targetEvent->action = strtolower($routeMatch->getParam('action', 'not-found'));
        $controllerName = $routeMatch->getParam('controller', 'not-found');
        $targetEvent->controller = strtolower(array_pop(explode('\\', $controllerName)));
        return $targetEvent;
    }

    public function setRedirect ($event, $resource)
    {
        $router = $event->getRouter();
        $url = $router->assemble($resource, array ('name' => 'base'));
        $response = $event->getResponse();
        $response->setStatusCode(302);
        $response->getHeaders()->addHeaderLine('Location', $url);
        $event->stopPropagation();
    }

    public function checkPrivilege ($event)
    {
        $acl = new Acl();
        $acl->deny();
        $ServiceAcl = new ServiceAcl($this->getEntityManager());
        $roles = $ServiceAcl->getAclRole();
        $accessControl = new AccessControl();
        $acl = $accessControl->setRole($acl, $roles);
        $rolePermissions = $ServiceAcl->getAclRolePermission();
        $userMenu = $this->getUserMenu();
        if(empty($userMenu)) {
            $this->setUserMenu($rolePermissions);
            $userMenu = $this->getUserMenu();
        }
        $activeMenu = $this->getControllerAction($event);
        $viewModel = $event->getViewModel();
        $viewModel->setVariable('userMenu', $userMenu);
        $viewModel->setVariable('activeMenu', $activeMenu);
        $acl = $accessControl->setRolePermission($acl, $rolePermissions);
        $targetEvent = $this->getControllerAction($event);
        $allowed = $accessControl->isPrivilegeAllowed($acl, $targetEvent, $this->getSessContainer()->userType);
        $resource = array ('controller' => 'error', 'action' => 'accessdenied');
        if (!$allowed) {
            $this->setRedirect($event, $resource, $event);
        }
    }

    private function getEntityManager ()
    {
        $sm = $this->getController()->getServiceLocator();
        $em = $sm->get('Doctrine\ORM\EntityManager');
        return $em;
    }

}
