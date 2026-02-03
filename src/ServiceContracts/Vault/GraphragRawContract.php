<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Graphrag\GraphragGetStatsResponse;
use Casedev\Vault\Graphrag\GraphragInitResponse;
use Casedev\Vault\Graphrag\GraphragProcessObjectParams;
use Casedev\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
