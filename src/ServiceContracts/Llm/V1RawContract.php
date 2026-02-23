<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Llm;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Llm\V1\V1CreateEmbeddingParams;
use Router\Llm\V1\V1ListModelsResponse;
use Router\Llm\V1\V1NewEmbeddingResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateEmbeddingParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1NewEmbeddingResponse>
     *
     * @throws APIException
     */
    public function createEmbedding(
        array|V1CreateEmbeddingParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListModelsResponse>
     *
     * @throws APIException
     */
    public function listModels(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
