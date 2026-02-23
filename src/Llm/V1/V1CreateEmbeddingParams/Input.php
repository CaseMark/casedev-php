<?php

declare(strict_types=1);

namespace Router\Llm\V1\V1CreateEmbeddingParams;

use Router\Core\Concerns\SdkUnion;
use Router\Core\Conversion\Contracts\Converter;
use Router\Core\Conversion\Contracts\ConverterSource;
use Router\Core\Conversion\ListOf;

/**
 * Text or array of texts to create embeddings for.
 *
 * @phpstan-type InputVariants = string|list<string>
 * @phpstan-type InputShape = InputVariants
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
