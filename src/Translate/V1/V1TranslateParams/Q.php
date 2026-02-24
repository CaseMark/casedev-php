<?php

declare(strict_types=1);

namespace CaseDev\Translate\V1\V1TranslateParams;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Core\Conversion\ListOf;

/**
 * Text to translate. Can be a single string or an array for batch translation.
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
