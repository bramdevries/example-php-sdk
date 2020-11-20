<?php

declare(strict_types=1);

namespace Api\Client;

use Api\Client\Endpoint\Todos;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\UriFactory;

final class Sdk
{
    private ClientBuilder $clientBuilder;

    public function __construct(ClientBuilder $clientBuilder = null, UriFactory $uriFactory = null)
    {
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
        $uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();

        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($uriFactory->createUri('https://jsonplaceholder.typicode.com'))
        );
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => 'My Custom SDK',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            )
        );
    }
    
    public function todos(): Todos
    {
        return new Endpoint\Todos($this);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }
}