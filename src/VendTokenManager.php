<?php

namespace SimpleSquid\LaravelVend;

use SimpleSquid\Vend\Resources\OneDotZero\Token;

interface VendTokenManager
{
    public function setToken(Token $token): void;

    public function getToken(): Token;

    public function hasToken(): bool;

    public function setDomainPrefix(string $domain_prefix): void;

    public function getDomainPrefix(): string;
}