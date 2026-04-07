<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Usage;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Usage\V1\V1RetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1RetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        array|V1RetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
