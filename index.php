<?php
namespace Core;

require_once __DIR__ . '/vendor/autoload.php';

use Core\Route;

$router = new Route();
$router::start();