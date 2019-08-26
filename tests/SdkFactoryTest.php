<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples\Test;

use GuzzleHttp\Psr7\Response;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Starweb\Api\Authentication\ClientCredentials;
use Starweb\Sdk\Examples\SdkFactory;
use Starweb\Starweb;

class SdkFactoryTest extends TestCase
{
    public function testCreateSdk()
    {
        $factory = new SdkFactory();
        $clientCredentials = new ClientCredentials('foo', 'bar');
        $client = new Client();

        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $response = $this->createMock(Response::class);
        $response->method('getBody')->willReturn(
            $streamFactory->createStream(
                '{"access_token": "token", "expires_in": 3600}'
            )
        );
        $response->method('getStatusCode')->willReturn(200);
        $client->addResponse($response);

        $sdk = $factory->create($clientCredentials, 'http://localhost', $client);
        $this->assertInstanceOf(Starweb::class, $sdk);

        // create another sdk to test the return of the static sdk property
        $sdk = $factory->create($clientCredentials, 'http://localhost', $client);
        $this->assertInstanceOf(Starweb::class, $sdk);
    }
}
