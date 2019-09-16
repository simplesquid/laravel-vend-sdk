<?php
/**
 * Copyright (c) 2019 Matthew Poulter. All rights reserved.
 */

namespace SimpleSquid\LaravelVend\Controllers;

use Illuminate\Http\Request;
use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\VendTokenManager;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class VendOauthRedirectController
{
    public function __invoke(Request $request, VendTokenManager $tokenManager): Response
    {
        abort_if($request->has('error') ||
                 !$request->has(['domain_prefix', 'code', 'state']),
                 Response::HTTP_UNAUTHORIZED);

        try {
            $token = Vend::domainPrefix($request->domain_prefix)
                         ->oAuthAuthorisationCode($request->code);

            $tokenManager->setToken($token);
            $tokenManager->setDomainPrefix($request->domain_prefix);
        } catch (Throwable $e) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        return redirect($request->state, Response::HTTP_SEE_OTHER);
    }
}
