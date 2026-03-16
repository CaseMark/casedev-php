<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Skills;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\Custom\CustomListParams;
use CaseDev\Skills\Custom\CustomListResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface CustomRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CustomListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CustomListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
