<?php

namespace SimpleSquid\LaravelVend\Facades;

use Illuminate\Support\Facades\Facade;
use SimpleSquid\Vend\Actions\BrandsManager;
use SimpleSquid\Vend\Actions\ChannelRequestLogManager;
use SimpleSquid\Vend\Actions\ConsignmentsManager;
use SimpleSquid\Vend\Actions\CustomerGroupsManager;
use SimpleSquid\Vend\Actions\CustomersManager;
use SimpleSquid\Vend\Actions\InventoryManager;
use SimpleSquid\Vend\Actions\OutletProductTaxesManager;
use SimpleSquid\Vend\Actions\OutletsManager;
use SimpleSquid\Vend\Actions\PaymentTypesManager;
use SimpleSquid\Vend\Actions\PriceBookProductsManager;
use SimpleSquid\Vend\Actions\PriceBooksManager;
use SimpleSquid\Vend\Actions\ProductImagesManager;
use SimpleSquid\Vend\Actions\ProductsManager;
use SimpleSquid\Vend\Actions\ProductTypesManager;
use SimpleSquid\Vend\Actions\RegistersManager;
use SimpleSquid\Vend\Actions\SalesManager;
use SimpleSquid\Vend\Actions\SearchManager;
use SimpleSquid\Vend\Actions\SuppliersManager;
use SimpleSquid\Vend\Actions\TagsManager;
use SimpleSquid\Vend\Actions\TaxesManager;
use SimpleSquid\Vend\Actions\UsersManager;
use SimpleSquid\Vend\Actions\WebhookManager;
use SimpleSquid\Vend\Resources\OneDotZero\Token;

/**
 * @method static string getAuthorisationUrl(string $previous_url)
 * @method static Token oAuthAuthorisationCode(string $code)
 * @method static Token refreshOAuthAuthorisationToken()
 * @method static \SimpleSquid\Vend\Vend domainPrefix(string $domain_prefix)
 * @method static \SimpleSquid\Vend\Vend clientId(string $client_id)
 * @method static \SimpleSquid\Vend\Vend clientSecret(string $client_secret)
 * @method static \SimpleSquid\Vend\Vend redirectUri(string $redirect_uri)
 * @method static \SimpleSquid\Vend\Vend personalAccessToken(string $access_token)
 * @method static \SimpleSquid\Vend\Vend confirmationTimeout(int $confirmation_timeout)
 * @method static \SimpleSquid\Vend\Vend requestTimeout(int $request_timeout)
 * @method static \SimpleSquid\Vend\Vend userAgent(string $user_agent)
 * @method static \SimpleSquid\Vend\Vend authorisationToken(Token $token)
 * @method static BrandsManager brand()
 * @method static ChannelRequestLogManager channelRequestLog()
 * @method static ConsignmentsManager consignment()
 * @method static CustomersManager customer()
 * @method static CustomerGroupsManager customerGroup()
 * @method static InventoryManager inventory()
 * @method static OutletsManager outlet()
 * @method static OutletProductTaxesManager outletProductTax()
 * @method static PaymentTypesManager paymentType()
 * @method static PriceBooksManager priceBook()
 * @method static PriceBookProductsManager priceBookProduct()
 * @method static ProductsManager product()
 * @method static ProductImagesManager productImage()
 * @method static ProductTypesManager productType()
 * @method static RegistersManager register()
 * @method static SalesManager sale()
 * @method static SearchManager search()
 * @method static SuppliersManager supplier()
 * @method static TagsManager tag()
 * @method static TaxesManager tax()
 * @method static UsersManager user()
 * @method static WebhookManager webhook()
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
