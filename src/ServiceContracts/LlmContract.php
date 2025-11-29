<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface LlmContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function getConfig(
        ?RequestOptions $requestOptions = null
    ): mixed;
}
