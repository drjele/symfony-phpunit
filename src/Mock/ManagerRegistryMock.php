<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Mock;

use Closure;
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
            static::getOnCreate()
        );
    }

    public static function getOnCreate(): Closure
    {
        return function (MockInterface $mock): void {
            $mock->shouldReceive('getManager')
                ->byDefault()
                ->andReturn(static::getEntityManagerMock());
        };
    }

    public static function getClassMetadataMock(): MockInterface
    {
        $classMetadataMock = Mockery::mock(ClassMetadata::class);

        $classMetadataMock->shouldReceive('setIdGeneratorType')
            ->byDefault()
            ->andReturnSelf();

        $classMetadataMock->shouldReceive('setIdGenerator')
            ->byDefault()
            ->andReturnSelf();

        return $classMetadataMock;
    }

    public static function getEntityManagerMock(): MockInterface
    {
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

        $entityManagerMock->shouldReceive('clear')
            ->byDefault()
            ->andReturnSelf();

        $entityManagerMock->shouldReceive('getReference')
            ->byDefault()
            ->andReturnUsing(
                function (string $className, string|int $id): object {
                    $object = new $className();

                    if (\method_exists($object, 'setId')) {
                        $object->setId($id);
                    }

                    return $object;
                }
            );

        $entityManagerMock->shouldReceive('getClassMetadata')
            ->byDefault()
            ->andReturn(static::getClassMetadataMock());

        return $entityManagerMock;
    }
}
