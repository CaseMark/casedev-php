<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Privilege;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Privilege\V1\V1DetectParams;
use CaseDev\Privilege\V1\V1DetectResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1DetectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DetectResponse>
     *
     * @throws APIException
     */
    public function detect(
        array|V1DetectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
