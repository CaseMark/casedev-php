<?php

declare(strict_types=1);

namespace Router\ServiceContracts;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Llm\LlmGetConfigResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface LlmRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LlmGetConfigResponse>
     *
     * @throws APIException
     */
    public function getConfig(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
