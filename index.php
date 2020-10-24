<?php
// FRONT CONTROLLER
// Общие настройки
define('DEBUG_MODE', true);

if(DEBUG_MODE === true) {
	ini_set('display_errors',1);
	error_reporting(E_ALL);
}

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

require_once(ROOT.'/config/settings.php');

require_once(ROOT . '/components/functions.php');

$pdo = Connection::connect();

// Вызов Router
$router = new Router();
$router->run();