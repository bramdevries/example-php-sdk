<?php

use Api\Client\ClientBuilder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$clientBuilder = new ClientBuilder();
$clientBuilder->addPlugin(new HeaderDefaultsPlugin([
    'Accept' => 'application/json',
]));

$httpClient = $clientBuilder->getHttpClient();
$response = $httpClient->get('https://jsonplaceholder.typicode.com/todos/');