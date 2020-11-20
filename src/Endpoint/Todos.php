<?php

declare(strict_types=1);

namespace Api\Client\Endpoint;

use Api\Client\Sdk;
use Psr\Http\Message\ResponseInterface;

final class Todos
{
    private Sdk $sdk;

    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function all(): ResponseInterface
    {
        return $this->sdk->getHttpClient()->get('/todos');
    }
}