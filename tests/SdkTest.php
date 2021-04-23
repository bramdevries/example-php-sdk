<?php

declare(strict_types=1);

namespace Api\Client\Tests;

final class SdkTest extends TestCase
{
    public function testCanRequest200Response(): void
    {
        $httpClient = $this->givenSdk()->getHttpClient();
        $response = $httpClient->get('/todos');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
