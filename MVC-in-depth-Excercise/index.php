<?php
spl_autoload_register();

$uri = $_SERVER['REQUEST_URI'];
$junk = str_replace(basename(__FILE__), '', $_SERVER['PHP_SELF']);
$significantPart = str_replace($junk, '', $uri);
$uriParts = explode('/', $significantPart);
$controllerName = array_shift($uriParts);
$actionName = array_shift($uriParts);
$modelBinder = new \Core\ModelBinding\ModelBinder();
$request = new \Core\Http\Request(
    $controllerName,
    $actionName,
    $uriParts,
    $_SERVER['QUERY_STRING'],
    $junk,
    $_SERVER['HTTP_HOST']
);

$dbInfo = parse_ini_file('Config/db.ini');
$db = new \Core\Database\PDODatabase(new \PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']));

$container = new \Core\DependencyManagement\Container();
$container->cache(
    \Core\DependencyManagement\ContainerInterface::class,
    $container
);
$container->cache(\Core\Database\DatabaseInterface::class, $db);
$container->cache(\Core\Http\RequestInterface::class, $request);

$container->addDependency(
    \Src\Service\User\UserServiceInterface::class,
    \Src\Service\User\UserService::class
);

$container->addDependency(
    \Src\Repository\User\UserRepositoryInterface::class,
    \Src\Repository\User\UserRepository::class
);

$container->addDependency(\Core\ModelBinding\ModelBinderInterface::class,
    \Core\ModelBinding\ModelBinder::class
    );

$container->addDependency(
    \Src\Service\Dummy\DummyServiceInterface::class,
    \Src\Service\Dummy\DummyService::class
);

$container->addDependency(\Core\Views\ViewsInterface::class,
    \Core\Views\Views::class
);

$container->addDependency(\Core\ApplicationInterface::class,
    \Core\Application::class
    );

$container->addDependency(\Core\Http\UrlBuilderInterface::class,
    \Core\Http\UrlBuilder::class
);

$app = $container->resolve(\Core\ApplicationInterface::class);
$app->start();


