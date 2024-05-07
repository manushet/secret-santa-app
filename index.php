<?php

declare(strict_types= 1);

require_once __DIR__ . '/config/init.php';

use Kernel\Kernel;
use Kernel\Services;

$services = new Services();

$kernel = new Kernel($services);

$response = $kernel->run();

$response->send();