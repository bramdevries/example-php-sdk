<?php

declare(strict_types=1);

namespace Api\Client;

use Api\Client\Endpoint\Todos;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

final class Sdk
{
    private ClientBuilder $clientBuilder;
    
    private Options $options;

    public function __construct(Options $options = null)
    {
        $this->options = $options ?? new Options();
        
        $this->clientBuilder = $this->options->getClientBuilder();
        $uriFactory = $options->getUriFactory();

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