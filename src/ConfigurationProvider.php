<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples;

use Starweb\Api\Authentication\ClientCredentials;

class ConfigurationProvider
{
    public function getCredentials(): ClientCredentials
    {
        $clientId = $this->getClientId();
        $clientSecret = $this->getClientSecret();

        return new ClientCredentials($clientId, $clientSecret);
    }

    public function getBaseUrl()
    {
        return $this->getConfigurationOptionFromEnvironment('BASE_URL');
    }

    private function getClientId()
    {
        return $this->getConfigurationOptionFromEnvironment('CLIENT_ID');
    }

    private function getClientSecret()
    {
        return $this->getConfigurationOptionFromEnvironment('CLIENT_SECRET');
    }

    private function getConfigurationOptionFromEnvironment(string $name)
    {
        $option = \getenv($name);
        if (!$option) {
            throw new \RuntimeException("$name needs to be set as environment variable");
        }

        return $option;
    }
}
