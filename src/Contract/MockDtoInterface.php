<?php

declare(strict_types=1);

/*
 * Copyright (c) Constantin Adrian Jeledintan
 */

namespace Drjele\Utility\Phpunit\Contract;

use Drjele\Utility\Phpunit\MockDto;

interface MockDtoInterface
{
    public static function getMockDto(): MockDto;
}
