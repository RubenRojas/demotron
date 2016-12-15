<?php
header('Content-Type: text/html; charset=utf-8');
require 'AppConfig/conection.php';
require 'AppConfig/config.php';
require 'AppConfig/routes.php';

$app->run();