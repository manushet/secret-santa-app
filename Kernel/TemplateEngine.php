<?php

declare(strict_types= 1);

namespace Kernel;

class TemplateEngine {
    
    private const BASE_PATH = ROOT . '/view';

    static public function render(string $template, array $data = []): string
    {
        extract($data, EXTR_SKIP);

        ob_start();

        require(static::resolve($template));

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    static public function resolve(string $path): string
    {
        return static::BASE_PATH . "/{$path}";
    }
}