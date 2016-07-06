<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;

class index extends AbstractDispatchableController {

	public function index(Dispatcher $views){
		return $views->get("index.php");
	}

}


