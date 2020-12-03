<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\Container;

use Drjele\SymfonyPhpunit\Contract\MockDtoInterface;
use Drjele\SymfonyPhpunit\Exception\Exception;
use Drjele\SymfonyPhpunit\MockDto;
use Mockery;
use Mockery\MockInterface;

class MockContainer
{
    private array $mockDtos = [];
    private array $mocks = [];

    public function registerMockDto(MockDto $mockDto): self
    {
        if (isset($this->mockDtos[$mockDto->getClass()])) {
            throw new Exception(sprintf('Mock dto already registered for class "%s"!', $mockDto->getClass()));
        }

        $this->mockDtos[$mockDto->getClass()] = $mockDto;

        return $this;
    }

    public function getMock(string $class): MockInterface
    {
        if (!isset($this->mocks[$class])) {
            if (!isset($this->mockDtos[$class])) {
                throw new Exception(sprintf('No mock dto found for class "%s"!', $class));
            }

            $this->createMock($this->mockDtos[$class]);
        }

        return $this->mocks[$class];
    }

    public function registerMock(string $class, MockInterface $mock): self
    {
        if (isset($this->mocks[$class])) {
            throw new Exception(sprintf('Mock already registered for class "%s"!', $class));
        }

        $this->mocks[$class] = $mock;

        return $this;
    }

    public function close()
    {
        $this->mockDtos = [];

        Mockery::close();
    }

    private function getOrCreateMock(MockDto $mockDto): MockInterface
    {
        if (isset($this->mocks[$mockDto->getClass()])) {
            return $this->mocks[$mockDto->getClass()];
        }

        return $this->createMock($mockDto);
    }

    private function createMock(MockDto $mockDto): MockInterface
    {
        $mockedConstruct = [];

        foreach ($mockDto->getConstruct() as $dependency) {
            switch (true) {
                case $dependency instanceof MockDto:
                    $mockedDependency = $this->getOrCreateMock($dependency);
                    break;
                case $dependency instanceof MockDtoInterface || is_a($dependency, MockDtoInterface::class, true):
                    $mockedDependency = $this->getOrCreateMock($dependency::getMockDto());
                    break;

                default:
                    $mockedDependency = $dependency;
                    break;
            }

            $mockedConstruct[] = $mockedDependency;
        }

        $mock = empty($mockedConstruct) ?
            Mockery::mock($mockDto->getClass()) : Mockery::mock($mockDto->getClass(), $mockedConstruct);

        $this->registerMock($mockDto->getClass(), $mock);

        if ($mockDto->getPartial()) {
            $mock->makePartial();
        }

        if (null !== $mockDto->getOnCreate()) {
            $mockDto->getOnCreate()($mock);
        }

        return $mock;
    }
}
