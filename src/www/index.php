<?php

defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__)));

require_once  APP_PATH . '/../lib/ApiRestServer.php';

$api = new ApiRestServer();
$api->processRequest();


?>