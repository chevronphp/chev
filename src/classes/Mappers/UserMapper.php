<?php

namespace Mappers;

use Chevron\DB\PDOWrapper;
use Objects\UserFactory;
use Objects\User;

class UserMapper {

	protected $dbWrite;

	protected $userFactory;

	protected $hash;

	public function __construct(PDOWrapper $dbWrite, UserFactory $userFactory, $hash){
		$this->dbWrite = $dbWrite;
		$this->userFactory = $userFactory;
		$this->hash = $hash;
	}

	public function getFromId($id){
		$row = $this->getFromIds([(int)$id]);
		if(isset($row[$id])){
			return $row[$id];
		}
		return null;
	}

	public function getFromIds(array $ids){
		$sql = "select user_id, username, name_given, name_family, color, token, token_expired from users where user_id = %s";

		$ids = array_map("intval", $ids);
		$rows = $this->dbWrite->rows($sql, [$ids], true);

		$return = [];
		if($rows){
			foreach($rows as $row){
				$return[$row["user_id"]] = call_user_func_array([$this->userFactory, UserFactory::MAKE], $row);
			}
		}
		return $return;
	}

	public function getFromUsername($username){
		$sql = "select user_id, username, name_given, name_family, color, token, token_expired from users where username = ?";
		$row = $this->dbWrite->row($sql, [$username]);
		if($row){
			return call_user_func_array([$this->userFactory, UserFactory::MAKE], $row);
		}
		return null;
	}

	public function getFromToken($token){
		$sql = "select user_id, username, name_given, name_family, color, token, token_expired from users where token = ?";
		$row = $this->dbWrite->row($sql, [$token]);
		if($row){
			return call_user_func_array([$this->userFactory, UserFactory::MAKE], $row);
		}
		return null;
	}

	public function save(User $user){
		$attrs = [
			"user_id"       => $user->getId(),
			"username"      => $user->getUsername(),
			"name_given"    => $user->getNameGiven(),
			"name_family"   => $user->getNameFamily(),
			"token"         => $this->hash->quick(json_encode($user) . microtime()),
			"token_expired" => 0,
			"color"         => $user->getColor(),
		];

		if($user->getId()){
			$this->dbWrite->update("users", $attrs, [
				"user_id" => (int)$user->getId(),
			]);
		}else{
			$this->dbWrite->insert("users", $attrs);
			$id = $this->dbWrite->lastInsertId();
			$user->setId($id);
		}
		$user->setToken($attrs["token"]);
	}

	public function regenHash(User $user){
		if($user->getId()){
			$hash = $this->hash->quick(json_encode($user) . microtime());
			$this->dbWrite->update("users", [
				"token"   => $hash
			], [
				"user_id" => (int)$user->getId(),
			]);
			$user->setToken($hash);
		}
	}

	public function make($user_id, $username, $name_given, $name_family, $color, $token){
		$user = $this->userFactory->make($user_id, $username, $name_given, $name_family, $color, $token);
		$this->save($user);
		return $user;
	}


}


