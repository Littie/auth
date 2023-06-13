<?php
declare(strict_types=1);

use App\Core\Application;

const BASE_DIR = __DIR__ . '/..';

require_once '../vendor/autoload.php';

$app = new Application();

$response = $app->run();
$response->send();
