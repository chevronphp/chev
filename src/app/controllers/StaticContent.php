<?php

namespace Controllers;

class StaticContent extends Controller {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->di->get("views.dispatcher");
		$this->layout  = $this->di->get("layout.main");

		if($logger = $this->di->get("log.error.request")){
			$this->setLogger($logger);
		}
	}

	function index(){
		$this->layout->setView($this->widgets->get("index.php"));
		return $this->layout;
	}

}
