<?php
/**
 * Copyright (c) 2019 Matthew Poulter. All rights reserved.
 */

namespace SimpleSquid\LaravelVend\Controllers;

use SimpleSquid\LaravelVend\Facades\Vend;
use Symfony\Component\HttpFoundation\Response;

class VendOauthController
{
    public function __invoke(): Response
    {
        return redirect(Vend::getAuthorisationUrl(url()->previous()), Response::HTTP_SEE_OTHER);
    }
}
