<?php

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;

require __DIR__.'/../vendor/autoload.php';

ClassDiscovery::prependStrategy(MockClientStrategy::class);
