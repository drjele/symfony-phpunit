<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\Mock;

use Doctrine\Persistence\ManagerRegistry;
use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use Drjele\SymfonyPhpunit\MockDto;
use Mockery\MockInterface;

class ManagerRegistryMock implements MockDtoInterface
{
    public static function getMockDto(): MockDto
    {
        return new MockDto(
            ManagerRegistry::class,
            [],
            false,
            function (MockInterface $mock) {
                $mock->shouldReceive('getManager')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('beginTransaction')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('persist')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('remove')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('flush')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('commit')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('rollback')
                    ->byDefault()
                    ->andReturnSelf();
            }
        );
    }
}
