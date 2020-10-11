<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit\TestCase;

use Drjele\Utility\Phpunit\Container\MockContainerTrait;
use Drjele\Utility\Phpunit\Contract\MockDtoInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractKernelTestCase extends KernelTestCase implements MockDtoInterface
{
    use MockContainerTrait;
}
