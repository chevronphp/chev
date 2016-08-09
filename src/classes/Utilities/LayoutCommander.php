<?php

namespace Utilities;

use Controllers\www\users;

class LayoutCommander {

	protected $elements;
	protected $router;

	public function __construct($elements, $router, $flash, $views){
		$this->elements = $elements;
		$this->router   = $router;
		$this->views    = $views;
		$this->flash    = $flash;
	}

	public function setup($layout, $view){
// drop($this->flashStack(), __LINE__);
		$layout->setMany([
			"flash"  => $this->flashStack(),
			"logout" => $this->elements->a("logout", ["href" => $this->router->generate(users::class, "logout")]),
		]);

		$layout->setView($view);
		return $layout;
	}

	protected function flashStack(){
		$stack = $this->flash;
		$el    = $this->elements;
		return function()use($stack, $el){
			while (!$stack->isEmpty()) {
				list($type, $message, $context) = $stack->pop();
				echo $el->div($message, ["id" => "flash_stack", "class" => $type]);
			}
		};
	}

}

