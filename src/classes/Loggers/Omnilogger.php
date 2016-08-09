<?php

namespace Loggers;

class Omnilogger {

	protected $destination;

	public function __construct(callable $destination = null){
		$this->setDestination($destination);
	}

	public function setDestination(callable $destination){
		$this->destination = $destination;
	}

	public function log( $level, $message, array $context = array() ) {
		$this->destination = $this->destination ?: [$this, "cli"];
		call_user_func($this->destination, $level, $message, $context);
	}

	public function cli($level, $message, array $context = []){
		$context = ["log.level" => strtoupper($level), "log.message" => $message, "log.timestamp" => date("c (e)") ] + $context;

		$len = 0;
		foreach($context as $key => $value){
			if( ($l = strlen($key)) > $len){ $len = $l; }
		}

		$output = "\n\n".str_repeat("-", 72)."\n\n";

		foreach($context as $key => $value){
			$output .= sprintf("%{$len}s ... %-7s ... %s\n", $key, gettype($value), json_encode($value));
		}

		$output .= "\n\n\n";

		echo $output;
	}

	public function csv($level, $message, array $context = []){
		$log = [
			"log.level", strtoupper($level),
			"log.message", $message,
			"log.timestamp", date("c (e)"),
		];

		foreach($context as $key => $value){
			$log[] = $value;
		}

		$fp = fopen('php://temp', 'w+');
		$data = $this->flattenValues($data);
		fputcsv($fp, array_values($log), "\t");
		rewind($fp);
		$csv = stream_get_contents($fp);
		fclose($fp);
		return $csv;
	}

	public function __invoke($level, $message, array $context = []){
		$this->log($level, $message, $context);
	}

}
