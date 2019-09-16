<?php

namespace SimpleSquid\LaravelVend\Controllers;

use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\VendTokenManager;
use Symfony\Component\HttpFoundation\Response;

class VendOauthController
{
    public function __invoke(VendTokenManager $tokenManager): Response
    {
        if ($tokenManager->hasToken()) {
            return redirect(url()->previous());
        }

        return redirect(Vend::getAuthorisationUrl(url()->previous()), Response::HTTP_SEE_OTHER);
    }
}
