<?php

namespace Controllers;

class ErrorController extends Controller {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->di->get("views.dispatcher");
		$this->layout  = $this->di->get("layout.main");

		if($logger = $this->di->get("log.error.request")){
			$this->setLogger($logger);
		}
	}

	function __invoke(){
		list($method, $e) = func_get_args();
		$this->layout->setView($this->widgets->get("error.php", [
			"code" => get_class($e),
		]));
		return $this->layout;
	}

}
