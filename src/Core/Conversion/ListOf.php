<?php

declare(strict_types=1);

namespace Router\Core\Conversion;

use Router\Core\Conversion\Concerns\ArrayOf;
use Router\Core\Conversion\Contracts\Converter;

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
