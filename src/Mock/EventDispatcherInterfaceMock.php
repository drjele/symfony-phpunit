<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\Mock;

use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use Drjele\SymfonyPhpunit\MockDto;
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
            function (MockInterface $mock) {
                $mock->shouldReceive('dispatch')
                    ->byDefault()
                    ->andReturnSelf();
            }
        );
    }
}
