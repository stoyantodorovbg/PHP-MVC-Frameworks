<?php


spl_autoload_register(function($class){
    require_once $class.'.php';
});

//
//$url = explode("/", $_SERVER['REQUEST_URI']);
//
//array_shift($url);
//array_shift($url);
//
//$className = ucfirst(array_sh//ift($url));
//$methodName = array_shift($url);
//
//$classFullName = 'Controllers\\'.$className.'Controller';
//
//$obj = new $classFullName();
//
//


$selfFolder = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$uri = str_replace($selfFolder, '', $_SERVER['REQUEST_URI']);
$uriParts = explode('/', $uri);

$controllerName = 'Controllers\\'.array_shift($uriParts);
$methodName = array_shift($uriParts);
$controllerFullName = ucfirst($controllerName).'Controller';

$controller = new $controllerFullName();

$reflectM = new ReflectionMethod($controller, $methodName);
foreach ($reflectM->getParameters() as $param) {
    if ($param->getClass() == null) {
        continue;
    }
    $className = $param->getClass()->getName();
    $obj = new $className();
    foreach ($_POST as $paramName => $value) {
        $property = $param->getClass()->getProperty($paramName);
        $property->setAccessible(true);
        $property->setValue($obj, $value);
    }
    $position = $param->getPosition();
    $inserted = [$obj];
    array_splice($uriParts, $position, 0, $inserted);
}

call_user_func_array([$controller, $methodName], $uriParts);
