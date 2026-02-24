<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\V1CreateEmbeddingParams;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Core\Conversion\ListOf;

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
