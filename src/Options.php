<?php

declare(strict_types=1);

namespace Api\Client;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;

final class Options
{
    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'] ?? new ClientBuilder();
    }
    
    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'] ?? Psr17FactoryDiscovery::findUriFactory();
    }
}