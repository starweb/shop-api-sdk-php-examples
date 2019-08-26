<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples\Test\Unit;

use PHPUnit\Framework\TestCase;
use Starweb\Api\Authentication\ClientCredentials;
use Starweb\Sdk\Examples\ConfigurationProvider;

class ConfigurationProviderTest extends TestCase
{
    public function testGetters(): void
    {
        $provider = new ConfigurationProvider();
        $credentials = $provider->getCredentials();

        $this->assertSame('https://foo.test', $provider->getBaseUrl());
        $this->assertInstanceOf(ClientCredentials::class, $credentials);
        $this->assertSame('foo', $credentials->getId());
        $this->assertSame('bar', $credentials->getSecret());
    }

    public function testGetBaseUrlThrowsExceptionIfEnvironmentVarIsEmtpy(): void
    {
        \putenv('BASE_URL=');
        $provider = new ConfigurationProvider();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('BASE_URL needs to be set as environment variable');
        $provider->getBaseUrl();
    }

    public function testGetCredentialsThrowsExceptionIfClientIdEnvironmentVarIsEmtpy(): void
    {
        \putenv('CLIENT_ID=');
        $provider = new ConfigurationProvider();
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('CLIENT_ID needs to be set as environment variable');
        $provider->getCredentials();
    }

    public function testGetCredentialsThrowsExceptionIfClientSecretEnvironmentVarIsEmtpy(): void
    {
        \putenv('CLIENT_ID=foo');
        \putenv('CLIENT_SECRET=');
        $provider = new ConfigurationProvider();
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('CLIENT_SECRET needs to be set as environment variable');
        $provider->getCredentials();
    }
}
