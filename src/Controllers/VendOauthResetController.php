<?php

namespace SimpleSquid\LaravelVend\Controllers;

use SimpleSquid\LaravelVend\VendTokenManager;

class VendOauthResetController
{
    public function __invoke(VendTokenManager $tokenManager)
    {
        if ($tokenManager->hasToken()) {
            $tokenManager->destroyToken();
        }

        return back();
    }
}
