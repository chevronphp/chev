<?php

use Chevron\DB;

return function($di){

	$config = [];

	if(file_exists(dirname(DIR_BASE) . "/config.php")){
		$config = require dirname(DIR_BASE) . "/config.php";
	}

	$di->set("dbMaster", function() use($config){

		$c = function()use($config){
			$dbConn = new \PDO($config("pdo_conn"), $config("pdo_user"), $config("pdo_pass"));
			$dbConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		};

		$inst = new DB\PDOWrapper;
		$inst->setConnection($c);
		$inst->setDriver(new DB\Drivers\MySQLDriver);
		$inst->setWritable(true);

		return $inst;

	});

	$di->set("redis", function() use($config){
		return (new \Redis\Redis)->connect($config("redis_host"), $config("redis_port"));
	});

};
