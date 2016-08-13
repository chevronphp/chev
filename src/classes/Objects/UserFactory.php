<?php

namespace Objects;

class UserFactory {

	const MAKE = "make";

	public function make($userId, $username, $nameGiven, $nameFamily, $color, $token){
		return new User($userId, $username, $nameGiven, $nameFamily, $color, $token);
	}

}
