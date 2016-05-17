<?php

use Chevron\DB;

return function($di){


	if(file_exists(dirname(DIR_BASE) . "/config.php")){
		$config = require dirname(DIR_BASE) . "/config.php";
	}

	$di->set("db.mysql.master", function() use($config){

		$dbConn = new \PDO($config("pdo_conn"), $config("pdo_user"), $config("pdo_pass"));
		$dbConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		$inst = new DB\PDOWrapper;
		$inst->setConnection($dbConn);
		$inst->setDriver(new DB\Drivers\MySQLDriver);
		$inst->setWritable(true);

		return $inst;

	});

};
