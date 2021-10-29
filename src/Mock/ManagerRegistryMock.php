<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Drjele\Symfony\Phpunit\Contract\MockDtoInterface;
use Drjele\Symfony\Phpunit\MockDto;
use Mockery;
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
                $classMetadataMock = Mockery::mock(ClassMetadata::class);

                $classMetadataMock->shouldReceive('setIdGeneratorType')
                    ->byDefault()
                    ->andReturnSelf();

                $classMetadataMock->shouldReceive('setIdGenerator')
                    ->byDefault()
                    ->andReturnSelf();

                $entityManagerMock = Mockery::mock(EntityManagerInterface::class);

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

                $entityManagerMock->shouldReceive('getReference')
                    ->byDefault()
                    ->andReturnUsing(
                        fn (string $className): object => new $className()
                    );

                $entityManagerMock->shouldReceive('getClassMetadata')
                    ->byDefault()
                    ->andReturn($classMetadataMock);

                $mock->shouldReceive('getManager')
                    ->byDefault()
                    ->andReturn($entityManagerMock);
            }
        );
    }
}
