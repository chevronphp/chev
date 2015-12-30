<?php

return function($di){

	$di->set("log.error.router", function(){
		return new \Psr\Log\NullLogger;
	});

	$di->set("log.error.dispatcher", function(){
		return new \Psr\Log\NullLogger;
	});

	$di->set("log.drop", function(){
		return new \Chevron\Loggers\UserFuncLogger(function($l, $m, $c){
			drop($l, $m, $c);
		});
	});

};
