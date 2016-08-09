<?php

namespace Utilities;

class Hash {

	const COST = "cost";

	protected $algo = \PASSWORD_DEFAULT;

	protected $cost = 10;

	public function setAlgo($algo){
		$this->algo = $algo;
	}

	public function getAlgo(){
		return $this->algo;
	}

	public function setCost($cost){
		$this->cost = $cost;
	}

	public function getCost(){
		return $this->cost;
	}

	public function getInfo($hash){
		return password_get_info($hash);
	}

	public function hash($string){
		return password_hash($string, $this->algo, [static::COST => $this->cost]);
	}

	public function needsRehash($hash){
		return password_needs_rehash($string, $this->algo, [static::COST => $this->cost]);
	}

	public function verify($password, $hash){
		return password_verify($password, $hash);
	}

	public function quick($string, $algo = "sha256"){
		return hash($algo, $string);
	}

	public function quickFile($string, $algo = "sha256"){
		return hash_file($algo, $string);
	}

}

