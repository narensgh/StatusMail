<?php
namespace Management\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager,
    Zend\Session\Container as SessionContainer,
    Zend\Permissions\Acl\Acl,
    Zend\Permissions\Acl\Role\GenericRole as Role,
    Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Managementplugin extends AbstractPlugin
{
    protected $sesscontainer ;

    private function getSessContainer()
    {
        if (!$this->sesscontainer) {
            $this->sesscontainer = new SessionContainer('appl');
        }
        return $this->sesscontainer;
    }
    private function setupSession($e)
    {
        echo "setup session";
        $config = $e->getApplication()->getServiceManager()->get('Config');
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config['session']);
        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();
        SessionContainer::setDefaultManager($sessionManager);
    }

     public function doAuthorization($e)
    {
       $routeMatch = $e->getRouteMatch();
       $controller=$routeMatch->getParam('controller');
       $action=$routeMatch->getParam('action');
       if(!(($controller =='Management\Controller\Login') &&  ($action=='login' || $action=='forgotpassword'))){
      		if(!(isset($this->getSessContainer()->username ) && isset($this->getSessContainer()->userId))){
      			$router = $e->getRouter();
      			$url    = $router->assemble(array('controller'=>'login','action'=>'login'), array('name' => 'base'));
                        $response = $e->getResponse();
      			$response->setStatusCode(302);
      			$response->getHeaders()->addHeaderLine('Location', $url);
      			$e->stopPropagation();
      		}
      	}
    }
}