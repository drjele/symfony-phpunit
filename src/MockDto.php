<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit;

use Closure;

class MockDto
{
    private string $class;

    private array $construct;

    private bool $partial;

    private ?Closure $onCreate;

    public function __construct(
        string $class,
        array $construct = [],
        bool $partial = false,
        Closure $onCreate = null
    ) {
        $this->class = $class;
        $this->construct = $construct;
        $this->partial = $partial;
        $this->onCreate = $onCreate;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function getConstruct(): ?array
    {
        return $this->construct;
    }

    public function getPartial(): ?bool
    {
        return $this->partial;
    }

    public function getOnCreate(): ?Closure
    {
        return $this->onCreate;
    }
}
