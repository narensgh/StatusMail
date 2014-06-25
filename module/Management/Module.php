<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Management;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Management\Model\User;
use Management\Model\UserTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();        
        $eventManager->attach('route', array($this, 'loadConfiguration'), 2);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
		        
        $sharedEventManager = $eventManager->getSharedManager(); // The shared event manager
        
        $sharedEventManager->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) {
        	$routeMatch = $e->getRouteMatch();
            $viewModel = $e->getViewModel();
            $viewModel->setVariable('controller', $routeMatch->getParam('controller'));
            $viewModel->setVariable('action', $routeMatch->getParam('action'));
        });
        
//         Entity manager for docrine

        $em = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');
        $platform = $em->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
    }

    public function loadConfiguration(MvcEvent $e)
    {
    	$application   = $e->getApplication();
    	$sm            = $application->getServiceManager();
    	$sharedManager = $application->getEventManager()->getSharedManager();
    	 
    	$router = $sm->get('router');
    	$request = $sm->get('request');
    	 
    	$matchedRoute = $router->match($request);    	
    	if (null !== $matchedRoute) {
    		$sharedManager->attach('Zend\Mvc\Controller\AbstractActionController','dispatch',
    				function($e) use ($sm) {
    			$sm->get('ControllerPluginManager')->get('Managementplugin')
    			->doAuthorization($e); //pass to the plugin...
    		},2
    		);
    	}
    	else{
    		$url    = $router->assemble(array('controller'=>'login','action'=>'login'), array('name' => 'base'));
    		$response = $e->getResponse();
    		$response->setStatusCode(302);    		
    		$response->getHeaders()->addHeaderLine('Location', $url);
    		$response->sendHeaders();
    		$e->stopPropagation();
    	}    		
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }    
}
