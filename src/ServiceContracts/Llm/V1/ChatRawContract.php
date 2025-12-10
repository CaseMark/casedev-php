<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use Casedev\RequestOptions;

interface ChatRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|ChatCreateCompletionParams $params
     *
     * @return BaseResponse<ChatNewCompletionResponse>
     *
     * @throws APIException
     */
    public function createCompletion(
        array|ChatCreateCompletionParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
