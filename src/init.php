<?php

use Corpus\Autoloader\Psr4;
use Corpus\Autoloader\Psr0;
use Chevron\ErrHandler\ErrorHandler;
use Chevron\ErrHandler\ExceptionHandler;
use Chevron\ObjectLoader\ObjectLoader;
use Chevron\Containers\Di;
use Chevron\Kernel\Dispatcher\Dispatcher;
use Chevron\Kernel\Router\BasicRouter;
use Chevron\Kernel\Router\Route;


define("DIR_BASE", dirname(__FILE__));
define("DIR_UPLOADS", dirname(__DIR__) . "/uploads");
require dirname(DIR_BASE) . "/vendor/autoload.php";

spl_autoload_register(new Psr0(DIR_BASE . "/classes"));
spl_autoload_register(new Psr4("Controllers", DIR_BASE . "/routes"));

set_error_handler(new ErrorHandler);
set_exception_handler(new ExceptionHandler(ExceptionHandler::ENV_DEV));

$di = (new ObjectLoader)->loadObject(new Di, DIR_BASE . "/services");

if(is_cli()){
	$dispatcher = new Dispatcher($di, "\\Controllers\\cli");
	$layout     = $di->get("layoutDispatcher")->get("index.cli.php");
	$route      = $_SERVER["argv"][1];
}else{
	$dispatcher = new Dispatcher($di, "\\Controllers\\www");
	$layout     = $di->get("layoutDispatcher")->get("index.www.php");
	$route      = $_SERVER["REQUEST_URI"];
}

$di->set("layout", $layout); // add the layout to Di so that we can manipulate it.
$route = $di->get("router")->match($route);

try{
	$controller = $dispatcher->dispatch($route);
	$view       = call_user_func($controller);
}catch(\Exception $e){
	drop($e);
	$controller = $dispatcher->dispatch(new Route(error::class));
	$code       = $e->getCode() ?: 500;
	$view       = call_user_func($controller, ($action = null), [$e->getCode(), $e]);
}

if( is_int($view) ){
	exit($view);
}

$fulfillment = $di->get("fulfillment")->eachHeader('header');

$lc = $di->get("layoutCommander");
$layout = $lc->setup($layout, $view);

call_user_func($layout);

exit(0);
