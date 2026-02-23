<?php

declare(strict_types=1);

namespace Router\Superdoc\V1\V1AnnotateParams\Field;

use Router\Core\Concerns\SdkUnion;
use Router\Core\Conversion\Contracts\Converter;
use Router\Core\Conversion\Contracts\ConverterSource;

/**
 * Value to populate.
 *
 * @phpstan-type ValueVariants = string|float
 * @phpstan-type ValueShape = ValueVariants
 */
final class Value implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float'];
    }
}
