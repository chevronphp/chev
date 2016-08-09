<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;
use Mailjet\Resources;
use Objects\User;

class users extends AbstractDispatchableController {

	protected $hasher;
	protected $router;

	public function index(Dispatcher $views, $post, $forms, $hash, $router, $userMapper, $flash){
		$link = null;
		if($post && $post->get("username")){
			$username = $hash->quick($post->get("username"));
			$user = $userMapper->getFromUsername($username);
			if(!($user instanceof User)){
				$user = $this->create($userMapper, $post, $hash);
			}

			$link = sprintf("http://local.equalvalues.com%s", $router->generate(users::class, "login", "html", ["c" => $user->getToken()]));
			// $this->send($post->get("username"), $link);
			// return $this->redirect($this->router->generate(users::class));
		}

		return $views->get("user.php", [
			"username"   => $forms->text("username"),
			"nameGiven"  => $forms->text("name_given"),
			"nameFamily" => $forms->text("name_family"),
			"message"    => $link,
		]);
	}

	protected function login($userMapper, $get, $currentUser, $router){
		$user = $userMapper->getFromToken($get->get("c"));

		if(!($user instanceof User)){
			return $this->redirect($router->generate(users::class));
		}

		$userMapper->regenHash($user);
		$currentUser->set("user_id", __LINE__);
		return $this->redirect($router->generate(index::class));
	}

	protected function create($userMapper, $post, $hash){
		$username = $hash->quick($post->get("username"));
		$user = $userMapper->make(null, $username, $post->get("name_given"), $post->get("name_family"), null, null);
		return $user;
	}

	public function logout($currentUser, $router){
		$currentUser->set("user_id", null);
		return $this->redirect($router->generate(index::class));
	}

	protected function send($email, $link){
		$mj = $this->getDi()->get("mailjet");
		$body = [
			'FromEmail'  => "list@box370.net",
			'FromName'   => "Equal Values",
			'Subject'    => "Your Equal Values Login Link",
			'Text-part'  => "Please use this link ({$link}) to log into equalvalues.net",
			'Html-part'  => "Please use this <a href=\"{$link}\" target=\"_blank\">link</a> to log into equalvalues.net",
			'Recipients' => [
				[
					'Email' => $email
				]
			]
		];
		$response = $mj->post(Resources::$Email, ['body' => $body]);
		return $response->success(); // && var_dump($response->getData());
	}
}
