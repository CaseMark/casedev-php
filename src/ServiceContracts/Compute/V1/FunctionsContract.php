<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface FunctionsContract
{
    /**
     * @api
     *
     * @param string $env Environment name. If not specified, uses the default environment.
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id The unique identifier of the function
     * @param int $tail Number of log lines to retrieve (default 200, max 1000)
     *
     * @throws APIException
     */
    public function getLogs(
        string $id,
        int $tail = 200,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
