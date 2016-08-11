<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;

class add extends AbstractDispatchableController {

	protected $hasher;

	public function index(Dispatcher $views, $get, $forms, $elements, $currentUser, $flash, $router, $assetMapper, $layoutCommander){

		if(!($userId = $currentUser->get("user_id"))){
			$flash->notice("please log in");
			return $this->redirect($router->generate(users::class));
		}

		if(empty($get->get("on"))){
			$flash->warning("please choose a source image");
			return $this->redirect($router->generate(index::class));
		}

		$source = $assetMapper->getFromId($get->get("on"));
		$layoutCommander->set("shouldHide", true);
		return $views->get("add.php", [
			"source"               => $assetMapper->getFromId($get->get("on")),
			"sourceThumb"          => $elements->img(null, ["src" => "/images/{$source->getFname()}", "class" => "scaled-img"]),
			"object_number"        => $elements->span($get->get("on")),
			"object_number_hidden" => $forms->hidden("object_number", $get->get("on")),
			"collection"           => $forms->text("collection"),
			"title"                => $forms->text("title"),
			"description"          => $forms->textarea("description"),
		]);
	}

	public function uploadAsset($assetMapper, $post, array $files, $hash, $router, $flash){
		if($files && $post && $post->get("object_number")){

			try{
				$fname = $this->processUpload($files, $hash);
				$asset = $assetMapper->make($post->get("object_number"), $fname, $post->get("title"), $post->get("description"), 1, $post->get("collection"));
			}catch(\Exception $e){
				$flash->warning("invalid file");
			}
		}

		return $this->redirect($router->generate(index::class));
	}

	protected function processUpload(array $files, $hash){
		foreach($files as $input){
			foreach($input as $file){
				$ext = pathinfo($file["name"], PATHINFO_EXTENSION);
				if(in_array($ext, ["jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF"])){
					$hash  = $hash->quickFile($file["tmp_name"]);
					$fname = "{$hash}.{$ext}";
					$path  = sprintf("%s/%s", DIR_UPLOADS, $fname);
					move_uploaded_file($file["tmp_name"], $path);
					return $fname; // only one file
				}else{
					throw new \OutOfBoundsException;
				}
			}
		}
	}
}
