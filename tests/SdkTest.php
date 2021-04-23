<?php

declare(strict_types=1);

namespace Api\Client\Tests;

use Laminas\Diactoros\Response;

final class SdkTest extends TestCase
{
    public function testCanRequest200Response(): void
    {
        $httpClient = $this->givenSdk()->getHttpClient();
        $response = $httpClient->get('/todos');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanRequest201Response(): void
    {
        $this->mockClient->addResponse((new Response())->withStatus(201));

        $httpClient = $this->givenSdk()->getHttpClient();
        $response = $httpClient->post('/todos');

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testCanRequestMultiple201Responses(): void
    {
        $this->mockClient->addResponse((new Response())->withStatus(201));
        $this->mockClient->addResponse((new Response())->withStatus(201));

        $httpClient = $this->givenSdk()->getHttpClient();

        $this->assertEquals(201, $httpClient->post('/todos')->getStatusCode());
        $this->assertEquals(201, $httpClient->post('/todos')->getStatusCode());
    }
}
