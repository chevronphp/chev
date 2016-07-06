<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Kernel\Dispatcher\Interfaces\DispatchableInitializationInterface;

class error extends AbstractDispatchableController implements DispatchableInitializationInterface {

	protected $widgets;

	public function init($action = ""){
		$this->widgets = $this->getDi()->get("views");
	}

	public function __invoke(){
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
