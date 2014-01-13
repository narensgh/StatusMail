<?php
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '3306',
					'user'     => 'root',
					'password' => '',
					'dbname'   => 'application',
           		)
			)
		),
		'driver' => array(
			'management_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/Management/Model/Entity')
			),

			'orm_default' => array(
				'drivers' => array(
					'Management\Model\Entity' => 'management_entities'
				)
			)
		)
	)
);
