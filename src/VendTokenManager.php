<?php

namespace SimpleSquid\LaravelVend;

use SimpleSquid\Vend\Resources\OneDotZero\Token;

interface VendTokenManager
{
    /**
     * Retrieves the Token.
     *
     * @return \SimpleSquid\Vend\Resources\OneDotZero\Token
     */
    public function getToken(): Token;

    /**
     * Checks if a Token has been saved.
     *
     * @return bool
     */
    public function hasToken(): bool;

    /**
     * Saves the Token.
     *
     * @param  \SimpleSquid\Vend\Resources\OneDotZero\Token  $token
     */
    public function setToken(Token $token): void;
}