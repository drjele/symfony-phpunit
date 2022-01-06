<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

use Closure;
use Drjele\Symfony\Phpunit\Container\MockContainer;
use Drjele\Symfony\Phpunit\Contract\MockDtoInterface;
use Drjele\Symfony\Phpunit\MockDto;
use Mockery\MockInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatcherInterfaceMock implements MockDtoInterface
{
    public static function getMockDto(): MockDto
    {
        return new MockDto(
            EventDispatcherInterface::class,
            [],
            false,
            static::getOnCreate()
        );
    }

    public static function getOnCreate(): Closure
    {
        return function (MockInterface $mock, MockContainer $mockContainer): void {
            $mock->shouldReceive('dispatch')
                ->byDefault()
                ->andReturnSelf();
        };
    }
}
