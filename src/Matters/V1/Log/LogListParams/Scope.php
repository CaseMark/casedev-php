<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log\LogListParams;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Core\Conversion\ListOf;

/**
 * Filter by scope: matter, work_item, execution, sharing, all.
 *
 * @phpstan-type ScopeVariants = string|list<string>
 * @phpstan-type ScopeShape = ScopeVariants
 */
final class Scope implements ConverterSource
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
