<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\TestCase;

use Drjele\Symfony\Phpunit\Container\MockContainerTrait;
use Drjele\Symfony\Phpunit\Contract\MockDtoInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase implements MockDtoInterface
{
    use MockContainerTrait;
}
