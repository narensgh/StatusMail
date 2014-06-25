<?php 
namespace Management\Controller\Plugin;
  
use Zend\Mvc\Controller\Plugin\AbstractPlugin,
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
     
    public function doAuthorization($e)
    {            
       $routeMatch = $e->getRouteMatch();
       $controller=$routeMatch->getParam('controller');
       $action=$routeMatch->getParam('action');      
       if(!(($controller =='Management\Controller\Login') &&  ($action=='login'))){       
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