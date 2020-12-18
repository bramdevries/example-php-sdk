<?php

declare(strict_types=1);

namespace Api\Client;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class Options
{
    private array $options;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'client_builder' => new ClientBuilder(),
                'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
                'uri' => 'https://jsonplaceholder.typicode.com',
            ]
        );
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'];
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->options['uri']);
    }
}