<?php

declare(strict_types= 1);

namespace Kernel;

use Kernel\Exception\ConfigFileNotFoundException;

class Services
{

    private array $services;

    private const SERVICES_PATH = CONFIG . '/services.php';

    private function load($class)
    {
        $params = isset($this->services[$class]) ? $this->services[$class] : [];

        $args = [];

        if (count($params) > 0) {
            foreach ($params as $param) {
                $args[] = $this->load($param);
            }
        }

        $class = str_ireplace("::class", "", $class);

        return new $class(...$args);
    }    

    public function isValidConfigFile(): bool
    {
        if (file_exists(self::SERVICES_PATH)) {
            return true;
        } 
        throw new ConfigFileNotFoundException();
    }

    public function registerServices(): void
    {
        if ($this->isValidConfigFile()) {
            $services = require_once(self::SERVICES_PATH);

            foreach ($services as $class => $params) {
                $this->services[$class] = $params;
            }
        }
    }

    public function has(string $class): bool
    {
        return isset($this->services[$class]);
    }

    public function get(string $class): ?object
    {
        return $this->has($class) ? $this->load($class) : null;
    }
}