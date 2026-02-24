<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultSearchParams\Filters;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Core\Conversion\ListOf;

/**
 * Filter to specific document(s) by object ID. Accepts a single ID or array of IDs.
 *
 * @phpstan-type ObjectIDVariants = string|list<string>
 * @phpstan-type ObjectIDShape = ObjectIDVariants
 */
final class ObjectID implements ConverterSource
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
