<?php

namespace SimpleSquid\LaravelVend;

use Illuminate\Support\Facades\Facade;

/**
 * Class VendFacade
 * @package SimpleSquid\LaravelVend
 * @property \SimpleSquid\Vend\Actions\BrandsManager brand
 */
class VendFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'vend';
    }
}
