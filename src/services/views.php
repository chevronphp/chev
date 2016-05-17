<?php

return function($di){

	$di->set("layout.main", function(){
		return new \Chevron\Widgets\Layout(DIR_BASE . "/layouts/index.php");
	});

	$di->set("layout.cli", function(){
		return new \Chevron\Widgets\Layout(DIR_BASE . "/layouts/cli.php");
	});

	$di->set("views.dispatcher", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/views");
	});

};
