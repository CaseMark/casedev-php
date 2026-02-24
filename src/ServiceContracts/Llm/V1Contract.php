<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Llm;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use CaseDev\Llm\V1\V1ListModelsResponse;
use CaseDev\Llm\V1\V1NewEmbeddingResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type InputShape from \CaseDev\Llm\V1\V1CreateEmbeddingParams\Input
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
    ): V1NewEmbeddingResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listModels(
        RequestOptions|array|null $requestOptions = null
    ): V1ListModelsResponse;
}
