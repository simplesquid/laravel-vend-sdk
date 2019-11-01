<?php

namespace SimpleSquid\LaravelVend\Exceptions;

use Exception;

class TokenManagerException extends Exception
{
    public function __construct()
    {
        parent::__construct('Token Manager does not implement \SimpleSquid\LaravelVend\VendTokenManager.');
    }
}
