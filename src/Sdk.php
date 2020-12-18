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

    public function __construct(Options $options = null)
    {
        $options = $options ?? new Options();

        $this->clientBuilder = $options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($options->getUri()));
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