<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Graphrag\GraphragGetStatsResponse;
use CaseDev\Vault\Graphrag\GraphragInitResponse;
use CaseDev\Vault\Graphrag\GraphragProcessObjectParams;
use CaseDev\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
