<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Vault;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Vault\Graphrag\GraphragGetStatsResponse;
use Router\Vault\Graphrag\GraphragInitResponse;
use Router\Vault\Graphrag\GraphragProcessObjectParams;
use Router\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface GraphragRawContract
{
    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GraphragGetStatsResponse>
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GraphragInitResponse>
     *
     * @throws APIException
     */
    public function init(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Vault object ID
     * @param array<string,mixed>|GraphragProcessObjectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GraphragProcessObjectResponse>
     *
     * @throws APIException
     */
    public function processObject(
        string $objectID,
        array|GraphragProcessObjectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
