<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams;
use Casedev\Llm\V1\V1ListModelsResponse;
use Casedev\Llm\V1\V1NewEmbeddingResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
