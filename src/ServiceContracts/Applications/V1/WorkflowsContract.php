<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Applications\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface WorkflowsContract
{
    /**
     * @api
     *
     * @param string $id Workflow run ID
     * @param string $projectID Project ID (for authorization)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
