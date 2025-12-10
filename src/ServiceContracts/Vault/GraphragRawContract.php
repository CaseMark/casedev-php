<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface GraphragRawContract
{
    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function init(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
