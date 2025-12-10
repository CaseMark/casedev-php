<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface StreamingRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getURL(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
