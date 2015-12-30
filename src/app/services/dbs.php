<?php

use Chevron\DB;

return function($di){

	$di->set("db.mysql.master", function(){

		// you should set this in a config
		$dbConn = new \PDO("mysql:host=127.0.0.1;port=3306;dbname=localdb;charset=utf8", "root", "");
		$dbConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		$inst = new DB\PDOWrapper;
		$inst->setConnection($dbConn);
		$inst->setDriver(new DB\Drivers\MySQLDriver);
		$inst->setWritable(true);

		return $inst;

	});

};
