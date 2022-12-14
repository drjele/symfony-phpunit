<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Test\Container;

use Doctrine\Persistence\ManagerRegistry;
use Drjele\Symfony\Phpunit\Container\MockContainer;
use Drjele\Symfony\Phpunit\Mock\EventDispatcherInterfaceMock;
use Drjele\Symfony\Phpunit\Mock\ManagerRegistryMock;
use Drjele\Symfony\Phpunit\Mock\SluggerInterfaceMock;
use Drjele\Symfony\Phpunit\MockDto;
use Drjele\Symfony\Phpunit\Test\Utility\FirstMockDto;
use Drjele\Symfony\Phpunit\Test\Utility\SecondMockDto;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @internal
 */
final class MockContainerTest extends TestCase
{
    public function test(): void
    {
        $mockContainer = new MockContainer();

        $mockDto = new MockDto(
            FirstMockDto::class,
            [
                new MockDto(SecondMockDto::class),
                EventDispatcherInterfaceMock::class,
                ManagerRegistryMock::class,
                SluggerInterfaceMock::class,
            ],
            true
        );

        $mockContainer->registerMockDto($mockDto);

        /** @var FirstMockDto $mock */
        $mock = $mockContainer->getMock(FirstMockDto::class);

        static::assertInstanceOf(MockInterface::class, $mock);
        static::assertInstanceOf(FirstMockDto::class, $mock);
        static::assertInstanceOf(EventDispatcherInterface::class, $mock->getEventDispatcher());
        static::assertInstanceOf(ManagerRegistry::class, $mock->getManagerRegistry());
        static::assertInstanceOf(SluggerInterface::class, $mock->getSlugger());
    }
}
