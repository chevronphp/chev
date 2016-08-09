<?php

use \Chevron\Loggers\UserFuncLogger;

return function($di){

	$di->set("logDrop", function(){
		return new UserFuncLogger(function($l, $m, $c){
			drop($l, $m, $c);
		});
	});

};
