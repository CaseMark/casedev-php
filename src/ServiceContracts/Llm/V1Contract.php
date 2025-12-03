<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param array<mixed>|V1CreateEmbeddingParams $params
     *
     * @throws APIException
     */
    public function createEmbedding(
        array|V1CreateEmbeddingParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function listModels(?RequestOptions $requestOptions = null): mixed;
}
