<?php

declare(strict_types=1);

namespace Api\Client\Tests;

use Api\Client\Sdk;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function givenSdk(): Sdk
    {
        return new Sdk();
    }
}
