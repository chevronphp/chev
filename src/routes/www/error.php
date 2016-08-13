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
// drop($e, basename($e->getFile()), $e->getFile());
		return $this->widgets->get("error.php", [
			"eClass"   => get_class($e),
			"eMessage" => $e->getMessage(),
			"eCode"    => $e->getCode(),
			"eFile"    => basename($e->getFile()),
			"eLine"    => $e->getLine(),
			"eTrace"   => "",
			// "eTrace"   => $e->getTraceAsString(),
		]);
	}

}
