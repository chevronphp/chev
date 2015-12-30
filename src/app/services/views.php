<?php

return function($di){

	$di->set("layout.main", function(){
		return new \Chevron\Widgets\Layout(DIR_BASE . "/app/layouts/index.php");
	});

	$di->set("views.dispatcher", function(){
		return new \Chevron\Widgets\Dispatcher(DIR_BASE . "/app/views");
	});

};
