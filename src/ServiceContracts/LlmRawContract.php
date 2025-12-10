<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface LlmRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getConfig(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
