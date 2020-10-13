<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\TestCase;

use Drjele\SymfonyPhpunit\Container\MockContainerTrait;
use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractKernelTestCase extends KernelTestCase implements MockDtoInterface
{
    use MockContainerTrait;
}
