<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2;

use CaseDev\Agent\V2\Execute\ExecuteCreateParams;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ExecuteRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExecuteCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExecuteNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ExecuteCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
