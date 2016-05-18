<?php

namespace Controllers;

class StaticContent extends Controller {

	protected $widgets, $layout;

	function init(){
		$this->widgets = $this->getDi()->get("views.dispatcher");
		$this->layout  = $this->getDi()->get("layout.main");

		if($logger = $this->getDi()->get("log.error.request")){
			$this->setLogger($logger);
		}
	}

	function index(){
		$this->layout->setView($this->widgets->get("index.php"));
		return $this->layout;
	}
}


