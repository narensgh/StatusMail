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
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);        
        
        $em = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');
        $platform = $em->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        
        
//         $config = $e->getApplication()
//                   ->getServiceManager()
//                   ->get('Configuration');
//         $sessionConfig = new SessionConfig();
//         $sessionConfig->setOptions($config['session']);
//         $sessionManager = new SessionManager($sessionConfig);
//         $sessionManager->start();
//         print_r($sessionManager);
//         die('tested');
//         Container::setDefaultManager($sessionManager);
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
    public function getServiceConfig()
    { 
    	return array(
    			'factories' => array(
    				'Management\Model\UserTable' =>  function($sm) {
	    					$tableGateway = $sm->get('UserTableGateway');
	    					$table = new UserTable($tableGateway);
	    					return $table;
    					},
			    	'UserTableGateway' => function ($sm) {
					    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					    	$resultSetPrototype = new ResultSet();
					    	$resultSetPrototype->setArrayObjectPrototype(new User());
					    	return new TableGateway('login', $dbAdapter, null, $resultSetPrototype);
					   	},
			    	),
		    	);
    }
    
}
