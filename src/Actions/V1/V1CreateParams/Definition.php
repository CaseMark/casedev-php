<?php

declare(strict_types=1);

namespace Casedev\Actions\V1\V1CreateParams;

use Casedev\Core\Concerns\SdkUnion;
use Casedev\Core\Conversion\Contracts\Converter;
use Casedev\Core\Conversion\Contracts\ConverterSource;

/**
 * Action definition in YAML string, JSON string, or JSON object format.
 */
final class Definition implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'mixed'];
    }
}
