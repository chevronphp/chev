<?php

namespace Controllers\www;

use Controller\AbstractDispatchableController;
use Chevron\Widgets\Dispatcher;
use Mailjet\Resources;
use Objects\User;

class users extends AbstractDispatchableController {

	protected $hasher;
	protected $router;

	public function index(Dispatcher $views, $post, $forms, $hash, $router, $userMapper, $flash, $elements, $config){
		$link = null;
		if($post && $post->get("username")){
			$username = $hash->quick($post->get("username"));
			$user = $userMapper->getFromUsername($username);
			if(!($user instanceof User)){
				$user = $this->create($userMapper, $post, $hash);
			}

			$link = sprintf("%s%s", $config["tld"], $router->generate(users::class, "login", "html", ["c" => $user->getToken()]));

			if(!empty($config["email"])){
				$this->send($post->get("username"), $link);
			}
			$flash->notice("check your email");
			return $this->redirect($router->generate(users::class));
		}

		return $views->get("user.php", [
			"username"   => $forms->text("username"),
			"nameGiven"  => $forms->text("name_given"),
			"nameFamily" => $forms->text("name_family"),
			"colors"     => $this->colorSpread($elements, $forms),
			"message"    => $link,
		]);
	}

	protected function colorSpread($elements, $forms){
		return $elements->div(
			[
				$forms->radio("color", "red"),
				$elements->span("red", ["class" => "red"]),
				$forms->radio("color", "mustard"),
				$elements->span("mustard", ["class" => "mustard"]),
				$forms->radio("color", "teal"),
				$elements->span("teal", ["class" => "teal"]),
			], ["class" => "color_picker"]
		);
	}

	protected function login($userMapper, $get, $currentUser, $router, $flash){
		$user = $userMapper->getFromToken($get->get("c"));

		if(!($user instanceof User)){
			$flash->notice("please log in");
			return $this->redirect($router->generate(users::class));
		}

		$userMapper->regenHash($user);
		$currentUser->set("user_id", $user->getId());
		$flash->notice("logged in");
		return $this->redirect($router->generate(index::class));
	}

	protected function create($userMapper, $post, $hash){
		$username = $hash->quick($post->get("username"));
		$user = $userMapper->make(null, $username, $post->get("name_given"), $post->get("name_family"), $post->get("color"), null);
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
			'Text-part'  => "Please use the link below to log into equalvalues.net.\n\nYou may need to copy-n-paste it into your browser's address bar.\n\n{$link}\n\n",
			'Html-part'  => "Please use this <a href=\"{$link}\" target=\"_blank\">link</a> to log into equalvalues.net<br><br>",
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
