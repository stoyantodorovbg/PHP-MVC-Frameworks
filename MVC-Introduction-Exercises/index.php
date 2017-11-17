<?php
include 'config.php';
spl_autoload_register();
?>

<script src="js/index.js"></script>

<?php
$uri = $_SERVER['REQUEST_URI'];
$self = explode("/", $_SERVER['PHP_SELF']);
array_pop($self);
$replace = implode('/', $self);
$uri = str_replace($replace.'/', '', $uri);

$params = explode('/', $uri);
array_shift($params);

$controllerName = array_shift($params);
$controllerFullName = ucfirst($controllerName);
$actionName = array_shift($params);

$controllerFullName = 'Controllers\\'.$controllerFullName.'Controller';

if (class_exists($controllerFullName)) {
    $controller = new $controllerFullName();
    if (is_callable([$controller, $actionName])) {
        try{
            call_user_func_array([$controller, $actionName], $params);
        } catch (Error $e){
            header("Location: HTTP/1.0 404 Not Found");
        }
    }
} elseif ($controllerName = '' || empty($actionName)) {
    $controllerName = DEFAULT_CONTROLLER;
    $actionName = DEFAULT_ACTION;
    $controllerFullName = 'Controllers\\'.ucfirst($controllerName).'Controller';
    $controller = new $controllerFullName();
    call_user_func_array([$controller, $actionName], []);
} else {
    header("Location: HTTP/1.0 404 Not Found");
}

