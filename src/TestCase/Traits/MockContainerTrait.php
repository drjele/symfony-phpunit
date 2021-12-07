<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\TestCase\Traits;

use Drjele\Symfony\Phpunit\Container\MockContainer;

trait MockContainerTrait
{
    private MockContainer $mockContainer;

    protected function get(string $class)
    {
        return $this->mockContainer->getMock($class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockContainer = new MockContainer();

        $this->mockContainer->registerMockDto(static::getMockDto());
    }

    protected function tearDown(): void
    {
        $this->mockContainer->close();

        parent::tearDown();
    }
}
