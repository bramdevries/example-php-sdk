<?php

declare(strict_types=1);

namespace Api\Client\Tests;

use Http\Message\RequestMatcher\RequestMatcher;
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

    public function testCanHandle404s(): void
    {
        $this->mockClient->on(new RequestMatcher('404'), (new Response())->withStatus(404));

        $httpClient = $this->givenSdk()->getHttpClient();

        $this->assertEquals(200, $httpClient->get('/todos')->getStatusCode());
        $this->assertEquals(404, $httpClient->get('/404')->getStatusCode());
        $this->assertEquals(404, $httpClient->get('/404')->getStatusCode());
        $this->assertEquals(404, $httpClient->get('/404')->getStatusCode());
    }
}
