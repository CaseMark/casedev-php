<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Applications\V1;

use Router\Applications\V1\Workflows\WorkflowGetStatusParams;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface WorkflowsRawContract
{
    /**
     * @api
     *
     * @param string $id Workflow run ID
     * @param array<string,mixed>|WorkflowGetStatusParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        array|WorkflowGetStatusParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
