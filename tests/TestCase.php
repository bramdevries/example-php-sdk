<?php

declare(strict_types=1);

namespace Api\Client\Tests;

use Api\Client\ClientBuilder;
use Api\Client\Options;
use Api\Client\Sdk;
use Http\Mock\Client;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Client $mockClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = new Client();
    }

    protected function givenSdk(): Sdk
    {
        return new Sdk(new Options([
            'client_builder' => new ClientBuilder($this->mockClient),
        ]));
    }
}
