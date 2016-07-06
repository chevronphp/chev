<?php

namespace Controllers\cli;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;

class error extends AbstractDispatchableController {

	public function __invoke(Dispatcher $views){

		return $views->get("error.php", [
			"class"   => get_class($e),
			"message" => $e->getMessage(),
			"code"    => $e->getCode(),
			"file"    => $e->getFile(),
			"line"    => $e->getLine(),
			"trace"   => $e->getTraceAsString(),
		]);

	}

}
