<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\Speak\SpeakCreateParams;
use Casedev\Voice\V1\Speak\SpeakStreamParams;

interface SpeakContract
{
    /**
     * @api
     *
     * @param array<mixed>|SpeakCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|SpeakCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @param array<mixed>|SpeakStreamParams $params
     *
     * @throws APIException
     */
    public function stream(
        array|SpeakStreamParams $params,
        ?RequestOptions $requestOptions = null
    ): string;
}
