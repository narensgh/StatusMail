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
			                    'controller'    => 'Management\Controller\Index',
			                    'action'        => 'index',
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
			                        		'controller'    => 'Management\Controller\Index',
			                        		'action'        => 'index',
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
    								'controller'    => 'Index',
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
						'Management\Controller\Admin' => 'Management\Controller\AdminController'
				),
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
						'error/404'               => __DIR__ . '/../view/error/404.phtml',
						'error/index'             => __DIR__ . '/../view/error/index.phtml',
				),
				'template_path_stack' => array(
						__DIR__ . '/../view',
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
						'driver' => array(
								'management_entities' => array(
										'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
										'cache' => 'array',
										'paths' => array(__DIR__ . '/../src')
								),
				
								'orm_default' => array(
										'drivers' => array(
												'Management\Model\Entity' => 'management_entities'
										)
								))),
	);