<?php

declare(strict_types=1);

namespace Service\SecretSanta;

use Service\Messenger\MessengerServiceInterface;

class SecretSantaService {
    private array $users = [];

    public function __construct(private MessengerServiceInterface $messenger) {

    }

    public function addParticipants(string $usersInput): void {
        
        $users = preg_split("/[\s,;]+/", $usersInput);

        foreach ($users as $user) {            
            $this->users[] = trim($user);
        }
    }

    public function createPairs(): array {
        shuffle($this->users);
        
        $pairs = [];

        $count = count($this->users);

        if ($count > 1) {
            for ($i = 0; $i < $count; $i++) {
                $gifter = $this->users[$i];

                $receiver = $this->users[($i + 1) % $count];
                   
                $pairs[] = [
                    'gifter' => $gifter,
                    'receiver' => $receiver,
                ];
            }
        }

        return $pairs;
    }

    public function sendMessages($pairs): void {
        foreach ($pairs as $pair) {           
            $this->messenger->sendMessage($pair['gifter'], "You have been chosen as Secret Santa for {$pair['receiver']}");
        }
    }
}
