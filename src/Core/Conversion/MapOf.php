<?php

declare(strict_types=1);

namespace CaseDev\Core\Conversion;

use CaseDev\Core\Conversion\Concerns\ArrayOf;
use CaseDev\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
