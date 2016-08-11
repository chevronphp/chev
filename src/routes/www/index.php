<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;
use Chevron\Kernel\Router\Route;
use Chevron\Kernel\Router\Interfaces\RouterInterface;
use Objects\User;

class index extends AbstractDispatchableController {

	public function index(Dispatcher $views, $assetMapper, $get){
		$columns = [];
		$nCol = 0;
		foreach($assetMapper->getAll(null, $get->get("sort")) as $asset){
			$columns[$nCol][] = $asset;
			$nCol = $nCol >=3 ? 0 : $nCol += 1;
		}

		return $views->get("index.php", [
			"columns" => $columns,
		]);
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


