<?php
// App Root
define('APP_ROOT', dirname(__FILE__, 2));
// URL Root
const URL_ROOT = 'http://localhost/task-parus';
// App Name
const APP_NAME = 'TaskParus';
// Dotenv
$dotenv = \Dotenv\Dotenv::createImmutable(APP_ROOT . "/../");
$dotenv->load();
// Database Params
define("DB_HOST", $_ENV['HOST']);
define("DB_USERNAME", $_ENV['USERNAME']);
define("DB_PASSWORD", $_ENV['PASSWORD']);
define("DB_NAME", $_ENV['DBNAME']);