<?php declare(strict_types=1);

namespace Starweb\Sdk\Examples\Command;

use Starweb\Starweb;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SdkCommand extends Command
{
    /**
     * @var Starweb
     */
    private $sdk;

    public function __construct(Starweb $sdk)
    {
        $this->sdk = $sdk;
    }

    protected function configure()
    {
        $this->setName('sdk');
        $this->setDescription('console application to show the usage of the Starweb Shop Api Sdk for PHP');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $operations = $this->getOperationsFromSdk();
    }

    private function getOperationsFromSdk(): array
    {
        $operations = [];
        $client = $this->sdk->getClient();
        $reflection = new \ReflectionClass($client);
        $methods = $reflection->getMethods();
        foreach ($methods as $method) {
            $operations[$method->getName()] = $method;
        }

        return $operations;
    }
}
