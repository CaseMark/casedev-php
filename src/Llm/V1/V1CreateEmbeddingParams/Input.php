<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\V1CreateEmbeddingParams;

use Casedev\Core\Concerns\SdkUnion;
use Casedev\Core\Conversion\Contracts\Converter;
use Casedev\Core\Conversion\Contracts\ConverterSource;
use Casedev\Core\Conversion\ListOf;

/**
 * Text or array of texts to create embeddings for.
 *
 * @phpstan-type InputShape = string|list<string>
 */
final class Input implements ConverterSource
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
