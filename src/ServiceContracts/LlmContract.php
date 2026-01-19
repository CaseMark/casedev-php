<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\LlmGetConfigResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
