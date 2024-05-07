<?php

declare(strict_types=1);

namespace Service\Messenger;

use Service\Messenger\MessengerServiceInterface;

class EmailMessengerService implements MessengerServiceInterface {
    public function sendMessage($to, $message): void {
        $message = "Message sent to {$to}: {$message}<br>";
    }
}