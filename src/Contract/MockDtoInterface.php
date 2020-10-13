<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\SymfonyPhpunit\Contract;

use Drjele\SymfonyPhpunit\MockDto;

interface MockDtoInterface
{
    public static function getMockDto(): MockDto;
}
