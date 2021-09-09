<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Test\Utility;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class TestMockDto
{
    private SecondTestMockDto $secondTestMockDto;
    private EventDispatcherInterface $eventDispatcher;
    private ManagerRegistry $managerRegistry;
    private SluggerInterface $slugger;

    public function __construct(
        SecondTestMockDto $secondTestMockDto,
        EventDispatcherInterface $eventDispatcher,
        ManagerRegistry $managerRegistry,
        SluggerInterface $slugger
    ) {
        $this->secondTestMockDto = $secondTestMockDto;
        $this->eventDispatcher = $eventDispatcher;
        $this->managerRegistry = $managerRegistry;
        $this->slugger = $slugger;
    }

    public function getSecondTestMockDto(): SecondTestMockDto
    {
        return $this->secondTestMockDto;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    public function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    }

    public function getSlugger(): SluggerInterface
    {
        return $this->slugger;
    }
}
