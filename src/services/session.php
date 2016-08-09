<?php

use Chevron\Containers\Registry;

return function($di){

	$seg = function &($key){

		if( session_status() != PHP_SESSION_ACTIVE ) {
			session_start();
		}

		if( !isset($_SESSION[$key]) ) {
			$_SESSION[$key] = [];
		}

		return $_SESSION[$key];

	};


	$di->set("currentUser", function() use ($seg) {
		$arr =& $seg("current");
		return new Registry($arr);
	});


	$di->set("flash", function() use ($seg) {
		$arr =& $seg("flash");

		$set = new \Chevron\Containers\Stack($arr);
		$log = new \Chevron\Loggers\StackLog($set);

		return $log;
	});

};


