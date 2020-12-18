<?php

declare(strict_types=1);

namespace Api\Client;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

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
    
    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->options['uri'] ?? 'https://jsonplaceholder.typicode.com');
    }
}