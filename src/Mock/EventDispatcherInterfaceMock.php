<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit\Mock;

use Drjele\Utility\Phpunit\Contract\MockDtoInterface;
use Drjele\Utility\Phpunit\MockDto;
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
