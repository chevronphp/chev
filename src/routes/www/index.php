<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;
use Chevron\Kernel\Router\Route;
use Chevron\Kernel\Router\Interfaces\RouterInterface;
use Objects\User;

class index extends AbstractDispatchableController {

	public function index(Dispatcher $views, $currentUser, $userMapper, $elements){
		if($userId = $currentUser->get("user_id")){
			$user = $userMapper->getFromId($userId);
			if($user instanceof User){

			}
		}

		return $views->get("index.php");
	}

	public function add(Dispatcher $views, array $files, $router){
		return $this->redirect($router->generate(add::class));
	}

	public function detail($get, $assetMapper, $router){
		if(!($id = (int)$get->get("id"))){
			return $this->redirect($router->generate($this));
		}

		drop($id, $assetMapper->getFromId($id));

	}

}


