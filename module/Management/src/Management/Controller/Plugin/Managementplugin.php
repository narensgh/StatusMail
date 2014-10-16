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

    private function setupSession ($e)
    {
        echo "setup session";
        $config = $e->getApplication()->getServiceManager()->get('Config');
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config['session']);
        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();
        SessionContainer::setDefaultManager($sessionManager);
    }

    public function doAuthorization ($event)
    {
        $targetEvent = $this->getControllerAction($event);
        $actionAllowed = array ('login', 'forgotpassword');
        $resource = array ('controller' => 'login', 'action' => 'login');
        if (!(($targetEvent->controller == 'login') && (in_array($targetEvent->action, $actionAllowed)))) {
            if (!(isset($this->getSessContainer()->username) && isset($this->getSessContainer()->userId))) {
                $this->setRedirect($event, $resource);
            }
            $this->checkPrivilege($event);
        }
    }

    public function getUserMenu ($rolePermissions)
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
        return $userMenu;
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
        $userMenu = $this->getUserMenu($rolePermissions);
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
