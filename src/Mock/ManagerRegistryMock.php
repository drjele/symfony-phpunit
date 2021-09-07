<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

use Doctrine\Persistence\ManagerRegistry;
use Drjele\Symfony\Phpunit\Contract\MockDtoInterface;
use Drjele\Symfony\Phpunit\MockDto;
use Mockery\MockInterface;

class ManagerRegistryMock implements MockDtoInterface
{
    public static function getMockDto(): MockDto
    {
        return new MockDto(
            ManagerRegistry::class,
            [],
            false,
            function (MockInterface $mock): void {
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

                $mock->shouldReceive('getClassMetaData')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('setIdGeneratorType')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('setIdGenerator')
                    ->byDefault()
                    ->andReturnSelf();
            }
        );
    }
}
