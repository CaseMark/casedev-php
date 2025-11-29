<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\V1CreateEmbeddingParams;

/**
 * Format for returned embeddings.
 */
enum EncodingFormat: string
{
    case FLOAT = 'float';

    case BASE64 = 'base64';
}
