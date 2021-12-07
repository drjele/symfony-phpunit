<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\TestCase\Traits;

use Drjele\Symfony\Phpunit\Container\MockContainer;
use Drjele\Symfony\Phpunit\MockDto;

trait MockContainerTrait
{
    private ?MockContainer $mockContainer = null;

    protected function get(string $class)
    {
        return $this->mockContainer->getMock($class);
    }

    protected function registerMockDto(MockDto $mockDto): self
    {
        $this->mockContainer ??= new MockContainer();

        $this->mockContainer->registerMockDto($mockDto);

        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerMockDto(static::getMockDto());
    }

    protected function tearDown(): void
    {
        $this->mockContainer?->close();

        parent::tearDown();
    }
}
