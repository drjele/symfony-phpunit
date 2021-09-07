<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

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
            function (MockInterface $mock): void {
                $mock->shouldReceive('dispatch')
                    ->byDefault()
                    ->andReturnSelf();
            }
        );
    }
}
