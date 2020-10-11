<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit\Mock;

use Drjele\Utility\Phpunit\Contract\MockDtoInterface;
use Drjele\Utility\Phpunit\MockDto;
use Mockery\MockInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\String\UnicodeString;

class SluggerInterfaceMock implements MockDtoInterface
{
    public static function getMockDto(): MockDto
    {
        return new MockDto(
            SluggerInterface::class,
            [],
            false,
            function (MockInterface $mock) {
                $mock->shouldReceive('slug')
                    ->byDefault()
                    ->andReturn(new UnicodeString(uniqid()));
            }
        );
    }
}
