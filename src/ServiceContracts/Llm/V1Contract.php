<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param string|list<string> $input Text or array of texts to create embeddings for
     * @param string $model Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small)
     * @param int $dimensions Number of dimensions for the embeddings (model-specific)
     * @param 'float'|'base64'|EncodingFormat $encodingFormat Format for returned embeddings
     * @param string $user Unique identifier for the end-user
     *
     * @throws APIException
     */
    public function createEmbedding(
        string|array $input,
        string $model,
        ?int $dimensions = null,
        string|EncodingFormat $encodingFormat = 'float',
        ?string $user = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function listModels(?RequestOptions $requestOptions = null): mixed;
}
