<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit\TestCase;

use Drjele\Utility\Phpunit\Container\MockContainerTrait;
use Drjele\Utility\Phpunit\Contract\MockDtoInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase implements MockDtoInterface
{
    use MockContainerTrait;
}
