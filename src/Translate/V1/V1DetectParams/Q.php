<?php

declare(strict_types=1);

namespace Router\Translate\V1\V1DetectParams;

use Router\Core\Concerns\SdkUnion;
use Router\Core\Conversion\Contracts\Converter;
use Router\Core\Conversion\Contracts\ConverterSource;
use Router\Core\Conversion\ListOf;

/**
 * Text to detect language for. Can be a single string or an array for batch detection.
 *
 * @phpstan-type QVariants = string|list<string>
 * @phpstan-type QShape = QVariants
 */
final class Q implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
