<?php
spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once $class.'.php';
});

$selfFolder = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$uri = str_replace($selfFolder, '', $_SERVER['REQUEST_URI']);
$uriParts = explode('/', $uri);
$index = array_shift($uriParts);
$controllerName = array_shift($uriParts);

$controllerFullName = 'Controllers\\'.ucfirst($controllerName).'Controller';
$methodName = array_shift($uriParts);
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
