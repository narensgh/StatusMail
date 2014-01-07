<?php
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => '192.168.0.58',
					'port'     => '3306',
					'user'     => 'root',
					'password' => 'root',
					'dbname'   => 'status',
           		)
			)
		)
	)
);
