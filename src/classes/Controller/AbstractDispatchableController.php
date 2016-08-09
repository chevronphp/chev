<?php

namespace Controller;

use Chevron\Kernel\Dispatcher\Traits\DiAwareTrait;
use Chevron\Kernel\Dispatcher\Traits\RouteAwareTrait;
use Chevron\Kernel\Dispatcher\Interfaces\DispatchableInterface;
use Chevron\Containers\Traits\ReflectiveDiMethodParamsTrait;
use Traits\RedirectableControllerTrait;

abstract class AbstractDispatchableController implements DispatchableInterface {

	use ReflectiveDiMethodParamsTrait;
	use RedirectableControllerTrait;
	use DiAwareTrait;
	use RouteAwareTrait;

	public function __construct( $di, $route ){
		$this->setDi($di);
		$this->setRoute($route);
	}

	public function __invoke(){
		$action = $this->getRoute()->getAction();

		if(method_exists($this, $action)){
			return $this->callMethodFromReflectiveDiMethodParams($this->getDi(), $this, $action, func_get_args());
		}

		throw new \DomainException("Method not found: {$action}", 404);

	}

}
