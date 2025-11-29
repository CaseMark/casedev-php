<?php

declare(strict_types=1);

namespace Casedev\Core\Conversion;

use Casedev\Core\Conversion\Concerns\ArrayOf;
use Casedev\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
