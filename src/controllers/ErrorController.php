<?php

namespace Controllers;

class ErrorController extends Controller {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->getDi()->get("views.dispatcher");
		$this->layout  = $this->getDi()->get("layout.main");

		if($logger = $this->getDi()->get("log.error.request")){
			$this->setLogger($logger);
		}
	}

	function __invoke(){
		list($method, $e) = func_get_args();
		$this->layout->setView($this->widgets->get("error.php", [
			"class"   => get_class($e),
			"message" => $e->getMessage(),
			"code"    => $e->getCode(),
			"file"    => $e->getFile(),
			"line"    => $e->getLine(),
			"trace"   => $e->getTraceAsString(),
		]));
		return $this->layout;
	}

}
