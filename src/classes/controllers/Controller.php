<?php

namespace Controllers;

abstract class Controller extends \Chevron\Kernel\Dispatcher\AbstractDispatchableController {
	protected function getDi(){
		return $this->di;
	}
}
