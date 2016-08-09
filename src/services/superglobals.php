<?php

use Chevron\Containers\Registry;
use Chevron\Containers\Reference;

return function($di){

	$di->set("get", function(){
		$r = new Registry;
		$r->setMany($_GET);
		return $r;
	});

	$di->set("post", function(){
		$r = new Registry;
		$r->setMany($_POST);
		return $r;
	});

	/**
	 * present a consistent interface for file uploads, supports >=1 file fields
	 * with >=1 file each. the returned array is always the same. allows access to
	 * file uploads without needing to reference the global $_FILES array
	 */
	$di->set("files", function () {

		$files = [];

		if( !$_FILES ) {
			return $files;
		}

		$fields = array_keys($_FILES);
		foreach( $fields as $field ) {
			$file = [];
			foreach( $_FILES[$field] as $label => $value ) {
				if( is_array($value) ) {
					foreach( $value as $num => $val ) {
						$files[$field][$num][$label] = $val;
					}
				} else {
					$file[$label] = $value;
				}
			}
			if( $file ) {
				$files[$field][] = $file;
			}
		}
		return $files;
	});

};


