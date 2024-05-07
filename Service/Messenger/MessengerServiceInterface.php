<?php

declare(strict_types=1);

namespace Service\Messenger;

interface MessengerServiceInterface {
    public function sendMessage($to, $message);
}