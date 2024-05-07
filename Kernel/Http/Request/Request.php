<?php

declare(strict_types=1);

namespace Kernel\Http\Request;

use Kernel\Exception\BadRequestException;

class Request
{
    private function __construct(
        private readonly ?array $params,
        private readonly ?array $body,
        private readonly ?array $server,
    ) {
    }

    public static function createFromGlobals(): static
    {
        try {
            $request = new static(
                $_GET,
                $_POST,
                $_SERVER
            );

            return $request;
        } catch (\Exception $e) {
            throw new BadRequestException();
        }
    }

    public function input(string $param): ?string
    {
        return htmlspecialchars(trim($this->body[$param])) ?? null;
    }

    public function getMethod(): ?string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function isPost(): bool {
        return $this->getMethod() === 'POST';
    }
}