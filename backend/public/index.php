<?php

require_once(__DIR__ . '/../vendor/autoload.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Range,Authorization');
header('Access-Control-Expose-Headers: Content-Length,Content-Range');

use App\App;

$app = new App();
$app->run();