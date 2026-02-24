<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Applications\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
