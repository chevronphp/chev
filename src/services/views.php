<?php

use \Chevron\Widgets;

return function($di){

	$di->set("views", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/views", Widgets\Widget::class);
	});

	$di->set("layoutDispatcher", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/layouts", Widgets\Layout::class);
	});

	$di->set("layoutCommander", \Utilities\LayoutCommander::class);

	$di->set('fulfillment', function () {
		$fulfillment = new \Chevron\Kernel\Response\Headers;
		$fulfillment->setHeader('X-Powered-By', 'chevronphp');
		return $fulfillment;
	});

};
