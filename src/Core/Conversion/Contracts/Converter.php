<?php

declare(strict_types=1);

namespace Router\Core\Conversion\Contracts;

use Router\Core\Conversion\CoerceState;
use Router\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
