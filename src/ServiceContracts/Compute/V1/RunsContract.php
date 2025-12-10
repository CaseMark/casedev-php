<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface RunsContract
{
    /**
     * @api
     *
     * @param string $id Unique identifier of the compute run
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $env Environment name to filter runs by
     * @param string $function Function name to filter runs by
     * @param int $limit Maximum number of runs to return (1-100, default: 50)
     *
     * @throws APIException
     */
    public function list(
        ?string $env = null,
        ?string $function = null,
        int $limit = 50,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
