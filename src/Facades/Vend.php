<?php

namespace SimpleSquid\LaravelVend\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getAuthorisationUrl(string $previous_url)
 * @method static \SimpleSquid\Vend\Resources\OneDotZero\Token oAuthAuthorisationCode(string $code)
 * @method static \SimpleSquid\Vend\Resources\OneDotZero\Token refreshOAuthAuthorisationToken()
 * @method static \SimpleSquid\Vend\Vend domainPrefix(string $domain_prefix)
 * @method static \SimpleSquid\Vend\Vend clientId(string $client_id)
 * @method static \SimpleSquid\Vend\Vend clientSecret(string $client_secret)
 * @method static \SimpleSquid\Vend\Vend redirectUri(string $redirect_uri)
 * @method static \SimpleSquid\Vend\Vend personalAccessToken(string $access_token)
 * @method static \SimpleSquid\Vend\Vend confirmationTimeout(int $confirmation_timeout)
 * @method static \SimpleSquid\Vend\Vend requestTimeout(int $request_timeout)
 * @method static \SimpleSquid\Vend\Vend userAgent(string $user_agent)
 * @method static \SimpleSquid\Vend\Vend authorisationToken(\SimpleSquid\Vend\Resources\OneDotZero\Token $token)
 * @method static \SimpleSquid\Vend\Actions\BrandsManager brand()
 * @method static \SimpleSquid\Vend\Actions\ChannelRequestLogManager channelRequestLog()
 * @method static \SimpleSquid\Vend\Actions\ConsignmentsManager consignment()
 * @method static \SimpleSquid\Vend\Actions\CustomersManager customer()
 * @method static \SimpleSquid\Vend\Actions\CustomerGroupsManager customerGroup()
 * @method static \SimpleSquid\Vend\Actions\InventoryManager inventory()
 * @method static \SimpleSquid\Vend\Actions\OutletsManager outlet()
 * @method static \SimpleSquid\Vend\Actions\OutletProductTaxesManager outletProductTax()
 * @method static \SimpleSquid\Vend\Actions\PaymentTypesManager paymentType()
 * @method static \SimpleSquid\Vend\Actions\PriceBooksManager priceBook()
 * @method static \SimpleSquid\Vend\Actions\PriceBookProductsManager priceBookProduct()
 * @method static \SimpleSquid\Vend\Actions\ProductsManager product()
 * @method static \SimpleSquid\Vend\Actions\ProductImagesManager productImage()
 * @method static \SimpleSquid\Vend\Actions\ProductTypesManager productType()
 * @method static \SimpleSquid\Vend\Actions\RegistersManager register()
 * @method static \SimpleSquid\Vend\Actions\SalesManager sale()
 * @method static \SimpleSquid\Vend\Actions\SearchManager search()
 * @method static \SimpleSquid\Vend\Actions\SuppliersManager supplier()
 * @method static \SimpleSquid\Vend\Actions\TagsManager tag()
 * @method static \SimpleSquid\Vend\Actions\TaxesManager tax()
 * @method static \SimpleSquid\Vend\Actions\UsersManager user()
 * @method static \SimpleSquid\Vend\Actions\WebhookManager webhook()
 *
 * @see \SimpleSquid\Vend\Vend
 */
class Vend extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'vend';
    }
}