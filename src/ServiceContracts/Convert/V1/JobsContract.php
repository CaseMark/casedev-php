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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
