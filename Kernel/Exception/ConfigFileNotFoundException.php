<?php

namespace Kernel\Exception;

class ConfigFileNotFoundException extends HttpException
{
    protected $message = "Config file not found. Unable to proceed running the application";

    protected int $statusCode = 503;
}