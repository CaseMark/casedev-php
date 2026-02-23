<?php

declare(strict_types=1);

namespace Router\ServiceContracts;

use Router\Core\Exceptions\APIException;
use Router\Llm\LlmGetConfigResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface LlmContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getConfig(
        RequestOptions|array|null $requestOptions = null
    ): LlmGetConfigResponse;
}
