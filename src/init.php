<?php

use Corpus\Autoloader\Psr4;
use Chevron\ErrHandler\ErrorHandler;
use Chevron\ErrHandler\ExceptionHandler;
use Chevron\ObjectLoader\ObjectLoader;
use Chevron\Containers\Di;
use Chevron\Kernel\Dispatcher\Dispatcher;
use Chevron\Kernel\Dispatcher\ControllerNotFoundException;
use Chevron\Kernel\Dispatcher\ActionNotFoundException;
use Chevron\Kernel\Router\WebRouter;
use Chevron\Kernel\Router\Route;
use Chevron\Kernel\Controllers\FrontController;


define("DIR_BASE", dirname(__FILE__));
require dirname(DIR_BASE) . "/vendor/autoload.php";

spl_autoload_register(new Psr4("Controllers", DIR_BASE . "/routes"));

set_error_handler(new ErrorHandler);
set_exception_handler(new ExceptionHandler(ExceptionHandler::ENV_DEV));

$di = (new ObjectLoader)->loadObject(new Di, DIR_BASE . "/services");

if(is_cli()){
	$dispatcher = new Dispatcher($di, "\\Controllers\\cli");
	$layout     = $di->get("layout")->get("index.cli.php");
	$route      = $_SERVER["argv"][1];
}else{
	$dispatcher = new Dispatcher($di, "\\Controllers\\www");
	$layout     = $di->get("layout")->get("index.www.php");
	$route      = $_SERVER["REQUEST_URI"];
}

$route = (new WebRouter)->match($route);

try{
	$controller = $dispatcher->dispatch($route);
	$view       = call_user_func($controller);

}catch(ControllerNotFoundException $e){
	$controller = $dispatcher->dispatch(new Route(ErrorController::class));
	$view       = call_user_func($controller, ($action = null), [404, $e]);

}catch(ActionNotFoundException $e){
	$controller = $dispatcher->dispatch(new Route(ErrorController::class));
	$view       = call_user_func($controller, ($action = null), [404, $e]);

}catch(\Exception $e){
	$controller = $dispatcher->dispatch(new Route(ErrorController::class));
	$view       = call_user_func($controller, ($action = null), [500, $e]);
}

if( is_int($view) ){
	exit($view);
}

$fulfillment = $di->get("fulfillment")->eachHeader('header');

$layout->setView($view);

call_user_func($layout);

exit(0);
