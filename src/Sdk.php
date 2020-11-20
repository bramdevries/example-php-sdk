<?php

declare(strict_types=1);

namespace Api\Client;

use Http\Client\Common\HttpMethodsClientInterface;

final class Sdk
{
    private ClientBuilder $clientBuilder;

    public function __construct(ClientBuilder $clientBuilder = null)
    {
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
    }
    
    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }
}