<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Symfony\Phpunit\Contract;

use Drjele\Symfony\Phpunit\MockDto;

interface MockDtoInterface
{
    public static function getMockDto(): MockDto;
}
