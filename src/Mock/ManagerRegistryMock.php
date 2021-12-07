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
use Drjele\Symfony\Phpunit\Container\MockContainer;
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
            static::getOnCreate()
        );
    }

    public static function getOnCreate(): Closure
    {
        return function (MockInterface $mock, MockContainer $container): void {
            $mock->shouldReceive('getManager')
                ->byDefault()
                ->andReturn(static::getEntityManagerMock($container));
        };
    }

    public static function getEntityManagerMock(MockContainer $container): MockInterface
    {
        $container->registerMockDto(
            new MockDto(
                EntityManagerInterface::class,
                [],
                false,
                function (MockInterface $mock, MockContainer $container): void {
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

                    $mock->shouldReceive('clear')
                        ->byDefault()
                        ->andReturnSelf();

                    $mock->shouldReceive('getReference')
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

                    $mock->shouldReceive('getClassMetadata')
                        ->byDefault()
                        ->andReturn(static::getClassMetadataMock($container));
                }
            )
        );

        return $container->getMock(EntityManagerInterface::class);
    }

    public static function getClassMetadataMock(MockContainer $container): MockInterface
    {
        $container->registerMockDto(
            new MockDto(
                ClassMetadata::class,
                [],
                false,
                function (MockInterface $mock, MockContainer $container): void {
                    $mock->shouldReceive('setIdGeneratorType')
                        ->byDefault()
                        ->andReturnSelf();

                    $mock->shouldReceive('setIdGenerator')
                        ->byDefault()
                        ->andReturnSelf();
                }
            )
        );

        return $container->getMock(ClassMetadata::class);
    }
}
