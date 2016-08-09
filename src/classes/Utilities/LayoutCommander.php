<?php

namespace Utilities;

use Controllers\www\users;
use Objects\User;

class LayoutCommander {

	protected $elements;
	protected $router;

	public function __construct($elements, $router, $flash, $views, $currentUser, $userMapper){
		$this->elements = $elements;
		$this->router   = $router;
		$this->views    = $views;
		$this->flash    = $flash;
		$this->user     = null;

		$user = $userMapper->getFromId($currentUser->get("user_id"));
		if($user instanceof User){
			$this->user = $user;
		}
	}

	public function setup($layout, $view){
		// drop($this->user);
		$layout->setMany([
			"flash"  => $this->flashStack(),
			"logout" => $this->elements->a("logout", ["href" => $this->router->generate(users::class, "logout")]),
			"welcome" => $this->user ? $this->elements->span($this->user->getNameGiven()) : "",
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

