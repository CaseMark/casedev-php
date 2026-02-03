<?php

declare(strict_types=1);

namespace Casedev\Superdoc\V1\V1AnnotateParams\Field;

use Casedev\Core\Concerns\SdkUnion;
use Casedev\Core\Conversion\Contracts\Converter;
use Casedev\Core\Conversion\Contracts\ConverterSource;

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
