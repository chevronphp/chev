<?php

use Corpus\Autoloader\Psr4;
use Chevron\ErrHandler\ErrorHandler;
use Chevron\ErrHandler\ExceptionHandler;
use Chevron\ObjectLoader\ObjectLoader;
use Chevron\Containers\Di;
use Chevron\Kernel\Dispatcher\Dispatcher;
use Chevron\Kernel\Router\BasicRouter;
use Chevron\Kernel\Controllers\FrontController;

define("DIR_BASE", dirname(__FILE__));
require dirname(DIR_BASE) . "/vendor/autoload.php";

define("DIR_DB", dirname(DIR_BASE) . "/server");

spl_autoload_register(new Psr4("Controllers", DIR_BASE . "/app/controllers"));

set_error_handler(new ErrorHandler);
set_exception_handler(new ExceptionHandler(ExceptionHandler::ENV_DEV));

$di         = (new ObjectLoader)->loadObject(new Di, DIR_BASE . "/app/services");
$dispatcher = new Dispatcher($di, "\\Controllers");
$router     = new BasicRouter;
$app        = new FrontController($di, $dispatcher, $router);

$app->setIndexController("\\StaticContent");
$app->setErrorController("\\ErrorController");

$route =  isset($_SERVER["argv"][1]) ? $_SERVER["argv"][1] : $_SERVER["REQUEST_URI"];

$view = $app->invoke($route);

call_user_func($view);

exit(0);
