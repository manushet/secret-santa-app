<?php

namespace Kernel\Exception;

class BadRequestException extends HttpException
{
    protected $message = "Bad http request, unable to proceed";

    protected int $statusCode = 400;
}