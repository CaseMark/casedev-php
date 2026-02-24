<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Llm;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\V1\V1CreateEmbeddingParams;
use CaseDev\Llm\V1\V1ListModelsResponse;
use CaseDev\Llm\V1\V1NewEmbeddingResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
