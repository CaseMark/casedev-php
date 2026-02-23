<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Privilege;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Privilege\V1\V1DetectParams;
use Router\Privilege\V1\V1DetectResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
