<?php

namespace SimpleSquid\LaravelVend\Exceptions;

use Exception;

class RouteException extends Exception
{
    public function __construct()
    {
        parent::__construct('Redirect URI route not set.');
    }
}
