<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultSearchParams\Filters;

use Casedev\Core\Concerns\SdkUnion;
use Casedev\Core\Conversion\Contracts\Converter;
use Casedev\Core\Conversion\Contracts\ConverterSource;
use Casedev\Core\Conversion\ListOf;

/**
 * Filter to specific document(s) by object ID. Accepts a single ID or array of IDs.
 *
 * @phpstan-type ObjectIDShape = string|list<string>
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
