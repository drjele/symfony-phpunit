<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\TestCase;

use Drjele\SymfonyPhpunit\Container\MockContainerTrait;
use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase implements MockDtoInterface
{
    use MockContainerTrait;
}
