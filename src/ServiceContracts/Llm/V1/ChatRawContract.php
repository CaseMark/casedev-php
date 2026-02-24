<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Llm\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\V1\Chat\ChatCreateCompletionParams;
use CaseDev\Llm\V1\Chat\ChatNewCompletionResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ChatRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ChatCreateCompletionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewCompletionResponse>
     *
     * @throws APIException
     */
    public function createCompletion(
        array|ChatCreateCompletionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
