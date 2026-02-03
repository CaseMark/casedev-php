<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Applications\V1;

use Casedev\Applications\V1\Workflows\WorkflowGetStatusParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
