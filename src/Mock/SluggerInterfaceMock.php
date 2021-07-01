<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\Mock;

use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use Drjele\SymfonyPhpunit\MockDto;
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
            function (MockInterface $mock): void {
                $mock->shouldReceive('slug')
                    ->byDefault()
                    ->andReturn(new UnicodeString(uniqid()));
            }
        );
    }
}
