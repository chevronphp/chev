<?php

namespace Utilities;

use Controllers\www\users;
use Objects\User;

class LayoutCommander {

	protected $elements;
	protected $flash;

	public function __construct($elements, $flash){
		$this->elements = $elements;
		$this->flash    = $flash;
	}

	public function setup($layout, $view){
		$layout->setMany([
			"flash"  => $this->flashStack(),
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

