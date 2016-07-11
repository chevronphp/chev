<?php

return function($di){

	$di->set("get", function(){
		return new \Objects\RequestFilter($_GET);
	});

	$di->set("post", function(){
		return new \Objects\RequestFilter($_POST);
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

	$di->set('fulfillment', function () {
		$fulfillment = new \Chevron\Kernel\Response\Headers;
		$fulfillment->setHeader('X-Powered-By', 'chevronphp');
		return $fulfillment;
	});

};


