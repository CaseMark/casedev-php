<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams;
use Casedev\RequestOptions;

interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateEmbeddingParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createEmbedding(
        array|V1CreateEmbeddingParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listModels(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
