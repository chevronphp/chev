<?php

use \Chevron\Widgets;

return function($di){

	$di->set("views", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/views", Widgets\Widget::class);
	});

	$di->set("layout", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/layouts", Widgets\Layout::class);
	});

};
