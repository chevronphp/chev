<?php

namespace Controllers;

use Chevron\Kernel\Dispatcher\AbstractDispatchableController;

abstract class Controller extends AbstractDispatchableController {

	protected function getDi(){
		return $this->di;
	}

}
