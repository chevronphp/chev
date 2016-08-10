<?php

namespace Objects;

class User {

	protected $userId;
	protected $username;
	protected $nameGiven;
	protected $nameFamily;
	protected $color;
	protected $token;
	protected $tokenExpired;

	public function __construct($userId, $username, $nameGiven, $nameFamily, $color, $token, $tokenExpired){
		$this->setId($userId);
		$this->setUsername($username);
		$this->setNameGiven($nameGiven);
		$this->setNameFamily($nameFamily);
		$this->setColor($color);
		$this->setToken($token);
		$this->setTokenExpired($tokenExpired);
	}

	public function getId(){
		return $this->userId;
	}

	public function setId($userId){
		if(is_null($this->userId)){
			$this->userId = $userId;
		}
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getNameGiven(){
		return $this->nameGiven;
	}

	public function setNameGiven($nameGiven){
		$this->nameGiven = $nameGiven;
	}

	public function getNameFamily(){
		return $this->nameFamily;
	}

	public function setNameFamily($nameFamily){
		$this->nameFamily = $nameFamily;
	}

	public function getColor(){
		return $this->color;
	}

	public function setColor($color){
		$this->color = $color;
	}

	public function getToken(){
		return $this->token;
	}

	public function setToken($token){
		$this->token = $token;
	}

	public function getTokenExpired(){
		return $this->tokenExpired;
	}

	public function setTokenExpired($tokenExpired){
		$this->tokenExpired = $tokenExpired;
	}


}


