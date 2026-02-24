<?php

declare(strict_types=1);

namespace CaseDev\Core\Conversion\Contracts;

use CaseDev\Core\Conversion\CoerceState;
use CaseDev\Core\Conversion\DumpState;

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
