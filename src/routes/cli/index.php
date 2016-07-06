<?php

namespace Controllers\Cli;

use Controller\AbstractDispatchableController;

class index extends AbstractDispatchableController {

	function index(){
		return function(){
			echo "hello world";
		};
	}
}


