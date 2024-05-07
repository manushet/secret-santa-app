<?php

declare(strict_types=1);

namespace Controller;

use Kernel\TemplateEngine;
use Kernel\Http\Request\Request;
use Kernel\Http\Response\Response;
use Service\SecretSanta\SecretSantaService;

class MainController {
    
    public function __construct(
        private SecretSantaService $secretSantaService,
        private TemplateEngine $view
        ) {
    }

    public function showPairs(Request $request): Response {

        $this->secretSantaService->addParticipants($request->input('emails'));

        $pairs = $this->secretSantaService->createPairs();

        if (!empty($pairs)) {
            $this->secretSantaService->sendMessages($pairs);

            return (new Response())->setContent(
                $this->view->render('main.php', [
                    'pairs' => $pairs
                ])
            );
        } else {
            return (new Response())->setContent(
                $this->view->render('main.php', [
                    'error' => 'Error! Failed generating Secret Santa pairs. Something went terribly wrong.'
                ])
            );
        }
    }

    public function index(): Response {
        return (new Response())->setContent(
            $this->view->render('main.php')
        );
    }
}