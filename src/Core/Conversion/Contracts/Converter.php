<?php

declare(strict_types=1);

namespace Casedev\Core\Conversion\Contracts;

use Casedev\Core\Conversion\CoerceState;
use Casedev\Core\Conversion\DumpState;

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
