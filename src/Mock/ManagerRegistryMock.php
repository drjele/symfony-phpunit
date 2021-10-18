<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

use Doctrine\ORM\EntityManagerInterface;
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
                $entityManagerMock = \Mockery::mock(EntityManagerInterface::class);

                $entityManagerMock->shouldReceive('beginTransaction')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('persist')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('remove')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('flush')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('commit')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('rollback')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('getClassMetadata')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('setIdGeneratorType')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock->shouldReceive('setIdGenerator')
                    ->byDefault()
                    ->andReturnSelf();

                $mock->shouldReceive('getManager')
                    ->byDefault()
                    ->andReturn($entityManagerMock);
            }
        );
    }
}
