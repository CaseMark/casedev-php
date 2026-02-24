<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\LlmGetConfigResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
