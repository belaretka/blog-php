<?php

use App\config\Config;
use \App\controller\BaseController;

require __DIR__ . '/vendor/autoload.php';

Config::load();
$controller = new BaseController();
$controller->handleRequest();
