<?php

return function($di){

	$di->set("get", function(){
		return new \Objects\RequestFilter($_GET);
	});

	$di->set("post", function(){
		return new \Objects\RequestFilter($_POST);
	});

	$di->set('fulfillment', function () {
		$fulfillment = new \Chevron\Kernel\Response\Headers;
		$fulfillment->setHeader('X-Powered-By', 'chevronphp');
		return $fulfillment;
	});

};


