<?php

namespace SimpleSquid\LaravelVend\Controllers;

use Illuminate\Http\Request;
use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\VendTokenManager;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class VendOauthRedirectController
{
    public function __invoke(Request $request, VendTokenManager $tokenManager)
    {
        abort_if($request->has('error') ||
                 !$request->has(['domain_prefix', 'code', 'state']),
                 Response::HTTP_UNAUTHORIZED);

        if ($tokenManager->hasToken()) {
            return redirect($request->state, Response::HTTP_SEE_OTHER);
        }

        try {
            $token = Vend::domainPrefix($request->domain_prefix)
                         ->oAuthAuthorisationCode($request->code);

            $tokenManager->setToken($token);
        } catch (Throwable $e) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        return redirect($request->state, Response::HTTP_SEE_OTHER);
    }
}
