<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples;

use Http\Client\HttpClient;
use Starweb\Api\Authentication\ClientCredentials;
use Starweb\Starweb;

class SdkFactory implements SdkFactoryInterface
{
    /**
     * @var Starweb
     */
    private static $sdk;

    /**
     * @var string
     */
    private static $apiBaseUri;

    /**
     * @inheritdoc
     */
    public function create(ClientCredentials $credentials, string $apiBaseUri, HttpClient $httpClient = null): Starweb
    {
        if (self::$sdk && self::$apiBaseUri && self::$apiBaseUri === $apiBaseUri) {
            return self::$sdk;
        }

        self::$apiBaseUri = $apiBaseUri;

        return self::$sdk = Starweb::create($credentials, $apiBaseUri, $httpClient);
    }
}
