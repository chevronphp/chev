<?php

use Chevron\DB;

return function($di){

	$di->set("dbWrite", function() use($di){

		$config = $di->get("config");
		$c = function()use($config){
			$dbConn = new \PDO($config("pdo_conn"), $config("pdo_user"), $config("pdo_pass"));
			$dbConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $dbConn;
		};

		$inst = new DB\PDOWrapper;
		$inst->setConnection($c);
		$inst->setDriver(new DB\Drivers\MySQLDriver);
		$inst->setWritable(true);

		return $inst;

	});

};
