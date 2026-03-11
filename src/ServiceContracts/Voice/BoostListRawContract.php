<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\BoostList\BoostListExtractParams;
use CaseDev\Voice\BoostList\BoostListExtractResponse;
use CaseDev\Voice\BoostList\BoostListGenerateParams;
use CaseDev\Voice\BoostList\BoostListGenerateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface BoostListRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BoostListExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BoostListExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        array|BoostListExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BoostListGenerateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BoostListGenerateResponse>
     *
     * @throws APIException
     */
    public function generate(
        array|BoostListGenerateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
