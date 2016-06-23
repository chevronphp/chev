<?php

namespace Controllers\Cli;

use Chevron\Kernel\Dispatcher\AbstractDispatchableController;

class index extends AbstractDispatchableController {

	function init(){}

	function index(){
		return function(){
			echo "hello world";
		};
	}
}


