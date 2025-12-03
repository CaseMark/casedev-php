<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface StreamingContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function getURL(?RequestOptions $requestOptions = null): mixed;
}
