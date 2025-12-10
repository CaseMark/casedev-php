<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Convert\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface JobsContract
{
    /**
     * @api
     *
     * @param string $id The unique identifier of the conversion job
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
     * @param string $id The job ID of the converted file to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
