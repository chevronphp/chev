<?php

return function($di){

	$di->set("GET", function(){
		return new \Objects\RequestFilter($_GET);
	});

	$di->set("POST", function(){
		return new \Objects\RequestFilter($_POST);
	});

};


