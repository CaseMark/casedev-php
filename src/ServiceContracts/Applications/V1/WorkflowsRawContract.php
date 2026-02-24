<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Applications\V1;

use CaseDev\Applications\V1\Workflows\WorkflowGetStatusParams;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
