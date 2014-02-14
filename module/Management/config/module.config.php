<?php
namespace Management;

 return array(
			'router' => array(
			    'routes' => array(
			        'management' => array(
			            'type'    => 'Zend\Mvc\Router\Http\Literal',
			            'options' => array(
			                'route'    => '/',
			                'defaults' => array(
			                    'controller'    => 'Management\Controller\Login',
			                    'action'        => 'login',
			                ),
			            ),
			            'may_terminate' => true,
			            'child_routes' => array(
			                'default' => array(
			                    'type'    => 'Segment',
			                    'options' => array(
			                        'route'    => 'management/[:controller[/:action]]',
			                        'constraints' => array(
			                            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
			                            'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
			                        ),
			                        'defaults' => array(
			                        		'controller'    => 'Management\Controller\Login',
			                    			'action'        => 'login',
			                        ),
			                    ),
			                ),
			            ),
			        ),
		    		'base' => array(
	    				'type' => 'segment',
	    				'options' => array(
    						'route'    => '/management[/:controller][/:action]',
    						'constraints' => array(
    								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
    								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
    						),
    						'defaults' => array(
    								'__NAMESPACE__' => 'Management\Controller',
    								'controller'    => 'Login',
    								'action'        => 'index',
    						),
	    				),
		    		),
			    ),
			),
		'service_manager' => array(
				'abstract_factories' => array(
						'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
						'Zend\Log\LoggerAbstractServiceFactory',
				),
				'aliases' => array(
						'translator' => 'MvcTranslator',
				),
		),
		'controllers' => array(
				'invokables' => array(
						'Management\Controller\Index' => 'Management\Controller\IndexController',
						'Management\Controller\Status' => 'Management\Controller\StatusController',
						'Management\Controller\Login' => 'Management\Controller\LoginController',
						'Management\Controller\Admin' => 'Management\Controller\AdminController',
				),
		),
 		'controller_plugins' => array(
 				'invokables' => array(
 						'Managementplugin' => 'Management\Controller\Plugin\Managementplugin',
 				)
 		),
		'view_manager' => array(
				'display_not_found_reason' => true,
				'display_exceptions'       => true,
				'doctype'                  => 'HTML5',
				'not_found_template'       => 'error/404',
				'exception_template'       => 'error/index',
				'template_map' => array(
						'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
						'management/index/index' => __DIR__ . '/../view/management/index/index.phtml',
						'menu'					=>	__DIR__ . '/../view/layout/menu.phtml',
						'error/404'               => __DIR__ . '/../view/error/404.phtml',
						'error/index'             => __DIR__ . '/../view/error/index.phtml',
				),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
				'strategies' => array(
						'ViewJsonStrategy',
				),
		),
		'translator' => array(
				'locale' => 'en_US',
				'translation_file_patterns' => array(
						array(
								'type'     => 'gettext',
								'base_dir' => __DIR__ . '/../language',
								'pattern'  => '%s.mo',
						),
				),
		),

// 				configuring doctrine
		'doctrine' => array(
				),
	);