<?php

declare(strict_types=1);

namespace Casedev\Core\Conversion;

use Casedev\Core\Conversion\Concerns\ArrayOf;
use Casedev\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
