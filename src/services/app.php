<?php

use Chevron\Kernel\Router\BasicRouter;
use Chevron\Kernel\Router\RouteFactory;

return function($di){

	$di->set("router", new BasicRouter("\\Controllers\\www"));

	$di->set("assetFactory", Objects\AssetFactory::class);

	$di->set("assetMapper", Mappers\AssetMapper::class);

	$di->set("userFactory", Objects\UserFactory::class);

	$di->set("userMapper", Mappers\UserMapper::class);

	$di->set("elements", Chevron\HTML\ElementDispatcher::class);

	$di->set("forms", Chevron\HTML\FormDispatcher::class);

	$di->set("select", Chevron\HTML\SelectDispatcher::class);

	$di->set("hash", Utilities\Hash::class);

	$di->set("mailjet", function(){
		return new Mailjet\Client("0774783be3bcae9a59daa142345e4bc1", "68e1b9245b3e51926c3f048ae242e9ff");
	});

	$di->set("config", function(){
		if(file_exists(dirname(DIR_BASE) . "/config.php")){
			$config = require dirname(DIR_BASE) . "/config.php";
		}
		return $config ?: [];
	});
};


