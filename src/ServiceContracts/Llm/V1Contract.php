<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type InputShape from \Casedev\Llm\V1\V1CreateEmbeddingParams\Input
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param InputShape $input Text or array of texts to create embeddings for
     * @param string $model Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small)
     * @param int $dimensions Number of dimensions for the embeddings (model-specific)
     * @param EncodingFormat|value-of<EncodingFormat> $encodingFormat Format for returned embeddings
     * @param string $user Unique identifier for the end-user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createEmbedding(
        string|array $input,
        string $model,
        ?int $dimensions = null,
        EncodingFormat|string $encodingFormat = 'float',
        ?string $user = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listModels(
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
