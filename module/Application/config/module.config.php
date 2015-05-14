<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router'          => array(
        'routes' => array(
            'home'        => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'          => 'segment',
                'options'       => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/:controller[/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults'    => array(
                            ),
                        ),
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
        'aliases'            => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator'      => array(
        'locale'                    => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers'     => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Pmfield' => 'Application\Controller\PmfieldController',
            'Application\Controller\Pmproject' => 'Application\Controller\PmprojectController',
             'Application\Controller\user' => 'Application\Controller\UserController',
            'Application\Controller\todolist' => 'Application\Controller\TodolistController',
            'Application\Controller\todo' => 'Application\Controller\TodoController',
            'Application\Controller\pmdiscussion' => 'Application\Controller\PmdiscussionController',
            'Application\Controller\Testb'=> 'Application\Controller\TestbController'

        ),
    ),
     'controller_plugins' => array(
        'invokables' => array(
            'Apiplugin' => 'Application\Controller\Plugin\Apiplugin',
        )
    ),
    'view_manager1'    => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error1/404',
        'exception_template'       => 'error1/index',
        'template_map'             => array(
            'layout/layout'          => __DIR__ . '/../view/layout/layoutwerfqwrqw.phtml',
            'management/index/index' => __DIR__ . '/../view/management/index/index.phtml',
            'menu'                   => __DIR__ . '/../view/layout/menu.phtml',
            'error1/404'              => __DIR__ . '/../view/error/404.phtml',
            'error1/index'            => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
        'strategies'               => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console'         => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'applicationEm' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Model/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Model\Entity' => 'applicationEm'
                )
            )
        )
    ),
);
