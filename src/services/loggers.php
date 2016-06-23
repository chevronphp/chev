<?php

return function($di){

	$di->set("logErrorRouter", function(){
		return new \Psr\Log\NullLogger;
	});

	$di->set("logErrorDispatcher", function(){
		return new \Psr\Log\NullLogger;
	});

	$di->set("logDrop", function(){
		return new \Chevron\Loggers\UserFuncLogger(function($l, $m, $c){
			drop($l, $m, $c);
		});
	});

};
