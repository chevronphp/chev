<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;

class add extends AbstractDispatchableController {

	protected $hasher;

	public function index(Dispatcher $views, $get, $forms, $elements, $currentUser, $flash, $router){

		if(!($userId = $currentUser->get("user_id"))){
			$flash->notice("please log in");
			return $this->redirect($router->generate(users::class));
		}

		return $views->get("add.php", [
			"object_number"        => $elements->span("_____"),
			"object_number_hidden" => $forms->hidden("object_number", $get->get("on")),
			"collection"           => $forms->text("collection"),
			"title"                => $forms->text("title"),
			"description"          => $forms->textarea("description"),
		]);
	}

	public function uploadAsset($assetMapper, $post, array $files){
		if($files && $post && $post->get("object_number")){
			$fname = $this->processUpload($files);
			$asset = $assetMapper->make($post->get("object_number"), $fname, $post->get("title"), $post->get("description"), 1, $post->get("collection"));
		}

		return $this->redirect($router->generate($this));
	}

	protected function processUpload(array $files){
		foreach($files as $input){
			foreach($input as $file){
				$ext = pathinfo($file["name"], PATHINFO_EXTENSION);
				if(in_array($ext, ["jpg", "jpeg", "png", "gif"])){
					$hash  = $this->hasher->quickFile($file["tmp_name"]);
					$fname = "{$hash}.{$ext}";
					$path  = sprintf("%s/%s", DIR_UPLOADS, $fname);
					move_uploaded_file($file["tmp_name"], $path);
					return $fname; // only one file
				}
			}
		}
	}
}
