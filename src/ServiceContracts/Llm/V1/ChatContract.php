<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Llm\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use Casedev\RequestOptions;

interface ChatContract
{
    /**
     * @api
     *
     * @param array<mixed>|ChatCreateCompletionParams $params
     *
     * @throws APIException
     */
    public function createCompletion(
        array|ChatCreateCompletionParams $params,
        ?RequestOptions $requestOptions = null,
    ): ChatNewCompletionResponse;
}
