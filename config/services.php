<?php

declare(strict_types=1);

require_once 'config/init.php';

use Kernel\TemplateEngine;
use Controller\MainController;
use Service\SecretSanta\SecretSantaService;
use Service\Messenger\EmailMessengerService;

return [
    MainController::class => [
        SecretSantaService::class,
        TemplateEngine::class,
    ],
    SecretSantaService::class => [
        EmailMessengerService::class,
    ]
];