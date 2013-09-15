<?php

require_once 'ApiRestServer.php';

defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__)));

$api = new ApiRestServer();
$api->processRequest();

?>