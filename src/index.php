<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Monolog\Logger;

require '../vendor/autoload.php';
require_once './controllers/Controller.php';
require_once  './controllers/LoginController.php';
require_once './controllers/StaticFileController.php';
require_once './controllers/AccountController.php';


$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'chenjiayao1802';
$config['db']['dbname'] = 'test';
$app = new \Slim\App(array(
  'debug' => true,
  'settings' => $config
));
$container = $app->getContainer();
$container['logger'] = function($c) {
  $logger = new \Monolog\Logger('my_logger');
  $file_handler = new \Monolog\Handler\StreamHandler('php://stdout');
  $logger->pushHandler($file_handler);
  return $logger;
};
$container['db'] = function ($c) {
  $db = $c['settings']['db'];
  $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
    $db['user'], $db['pass']);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES , FALSE);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};

// static files routing
$app->get('/assets[/{type}[/{filename}]]', function (Request $request, Response $response, array $args) {
  $controller = new StaticFileController($request, $response, $args);

  return $controller->serve();
});

// index, login, logout and register routing
$app->get('/', function (Request $request, Response $response, array $args) {
  $controller = new LoginController($request, $response, $args);

  return $controller->index();
});
$app->post('/login', function (Request $request, Response $response, array $args) {
  $controller = new LoginController($request, $response, $args);

  return $controller->login();
});
$app->get('/logout', function (Request $request, Response $response, array $args) {
  $controller = new LoginController($request, $response, $args);
  // decide if the user has the cookie, if yes, then the user can proceed to logout
  // otherwise, return to main page
  if (isset($_COOKIE["account"])) {
    return $controller->logout();
  } else {
    return $controller->index();
  }
});
$app->get('/register', function (Request $request, Response $response, array $args) {
  $controller = new LoginController($request, $response, $args);
  return $controller->register();
});

// two helper to keep the cookie alive. If the cookie times out, a user has to login again
function verify_login() {
  if (isset($_COOKIE["account"])) {
    return $_COOKIE["account"];
  } else {
    return FALSE;
  }
};

function login_helper($controller, $action) {
  return function(Request $request, Response $response, array $args) use ($controller, $action) {
    $cookie = verify_login();
    if ($cookie){
      setcookie("account", $cookie, time()+1800);
      $controller_intance = new $controller($request, $response, $args);
      return $controller_intance->$action();
    } else {
      return (new Controller($request, $response, $args))->render("html","session_time_out.html");
    }
  };
};

$app->get('/overview', login_helper("AccountController", "overview"));
$app->get('/overviewinfo', login_helper("AccountController", "info"));

$app->run();
?>