<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples;

use Http\Client\HttpClient;
use Starweb\Api\Authentication\ClientCredentials;
use Starweb\Starweb;

interface SdkFactoryInterface
{
    /**
     * @param ClientCredentials $credentials
     * @param string $apiBaseUri
     * @param HttpClient $httpClient
     *
     * @return Starweb
     * @throws \Http\Client\Exception
     */
    public function create(ClientCredentials $credentials, string $apiBaseUri, HttpClient $httpClient = null): Starweb;
}
