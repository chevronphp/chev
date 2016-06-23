<?php

namespace Controllers\www;

use Chevron\Kernel\Dispatcher\AbstractDispatchableController;

class ErrorController extends AbstractDispatchableController {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->getDi()->get("views");
	}

	function __invoke(){
		$fulfillment = $this->getDi()->get("fulfillment");

		list($code, $e) = func_get_args();

		$fulfillment->setStatusCode($code);

		return $this->widgets->get("error.php", [
			"class"   => get_class($e),
			"message" => $e->getMessage(),
			"code"    => $e->getCode(),
			"file"    => $e->getFile(),
			"line"    => $e->getLine(),
			"trace"   => $e->getTraceAsString(),
		]);
	}

}
