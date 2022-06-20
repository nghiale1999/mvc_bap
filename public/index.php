<?php

require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
// echo 'Requested URL = "'.$_SERVER['QUERY_STRING'].'"';


spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);  
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

error_reporting(E_ALL);
set_error_handler('core\Error::errorHandler');
set_exception_handler('core\Error::exceptionHandler');

$router = new core\Router();


// echo 'jsnd';

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}'); 
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

// echo '<pre>';
// var_dump($router->getRoutes());
// echo '</pre>';

// $url =$_SERVER['QUERY_STRING'];
// echo $url;  

// if ($router->matchs($url)) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } else {
//     echo "No route found for URL '$url'";
// }

$router->dispatch($_SERVER['QUERY_STRING']);

?>