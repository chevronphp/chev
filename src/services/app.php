<?php

use Chevron\Kernel\Router\BasicRouter;
use Chevron\Kernel\Router\RouteFactory;

return function($di){

	$di->set("router", new BasicRouter("\\Controllers\\www"));

	$di->set("elements", Chevron\HTML\ElementDispatcher::class);

	$di->set("forms", Chevron\HTML\FormDispatcher::class);

	$di->set("select", Chevron\HTML\SelectDispatcher::class);

	$di->set("config", function(){

		if(file_exists(dirname(DIR_BASE) . "/config.php")){
			$config = require dirname(DIR_BASE) . "/config.php";
		}
		return $config ?: [];
	});
};


