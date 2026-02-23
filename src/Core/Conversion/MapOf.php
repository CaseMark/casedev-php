<?php

declare(strict_types=1);

namespace Router\Core\Conversion;

use Router\Core\Conversion\Concerns\ArrayOf;
use Router\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
