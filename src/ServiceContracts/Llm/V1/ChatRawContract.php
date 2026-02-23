<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Llm\V1;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Llm\V1\Chat\ChatCreateCompletionParams;
use Router\Llm\V1\Chat\ChatNewCompletionResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
