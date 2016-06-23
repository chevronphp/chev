<?php

namespace Controllers\www;

use Chevron\Kernel\Dispatcher\AbstractDispatchableController;

class index extends AbstractDispatchableController {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->getDi()->get("views");
	}

	function index(){
		return $this->widgets->get("index.php");
	}
}


