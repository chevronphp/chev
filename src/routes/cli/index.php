<?php

namespace Controllers\Cli;

use Controller\AbstractDispatchableController;

class index extends AbstractDispatchableController {

	function index($dbWrite){

		$dbWrite->exec("truncate table assets");

		$n = 55;
		while($n -= 1){

			$descr = "This marble bust, which is a funerary portrait of a young boy, dates to the 1st Century A. D., Tiberian period. It was given to Lyndon B. Johnson by His Excellency Antonio Segni, President of Italy. The artist is unknown.";
			switch(0){
				case $n % 3:
					$dbWrite->insert("assets", [
						"fname"         => "882835cc57a07552e7cda938bd350ec2c1c2f71e.jpg",
						"object_number" => 12,
						"title"         => "Grandma Kvamme's doughnuts",
						"description"   => $descr,
						"user_id"       => 1,
					]);
					break;
				case $n % 2:
					$dbWrite->insert("assets", [
						"fname"         => "8b0c6d35474f5aa051d425cc9c20f29ed04f7359.jpg",
						"object_number" => 12,
						"title"         => "Grandma Kvamme's doughnuts",
						"description"   => "{$descr}\n\n{$descr}",
						"user_id"       => 1,
					]);
					break;
				case $n % 5:
					$dbWrite->insert("assets", [
						"fname"         => "5692868268_a483fdaa34_z.jpg",
						"object_number" => 12,
						"title"         => "Grandma Kvamme's doughnuts",
						"description"   => "{$descr}\n\n{$descr}\n\n{$descr}",
						"user_id"       => 1,
					]);
					break;
			}
		}
		return 0;
	}
}

