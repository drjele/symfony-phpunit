<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Test\Container;

use Drjele\Symfony\Phpunit\Container\MockContainer;
use Drjele\Symfony\Phpunit\Mock\EventDispatcherInterfaceMock;
use Drjele\Symfony\Phpunit\Mock\ManagerRegistryMock;
use Drjele\Symfony\Phpunit\Mock\SluggerInterfaceMock;
use Drjele\Symfony\Phpunit\MockDto;
use Drjele\Symfony\Phpunit\Test\Utility\SecondTestMockDto;
use Drjele\Symfony\Phpunit\Test\Utility\TestMockDto;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class MockContainerTest extends TestCase
{
    public function test(): void
    {
        $mockContainer = new MockContainer();

        $mockDto = new MockDto(
            TestMockDto::class,
            [
                new MockDto(SecondTestMockDto::class),
                EventDispatcherInterfaceMock::class,
                ManagerRegistryMock::class,
                SluggerInterfaceMock::class,
            ],
            true
        );

        $mockContainer->registerMockDto($mockDto);

        $mock = $mockContainer->getMock(TestMockDto::class);

        static::assertInstanceOf(MockInterface::class, $mock);
    }
}
