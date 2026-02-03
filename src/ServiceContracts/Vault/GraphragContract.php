<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Graphrag\GraphragGetStatsResponse;
use Casedev\Vault\Graphrag\GraphragInitResponse;
use Casedev\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface GraphragContract
{
    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): GraphragGetStatsResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function init(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): GraphragInitResponse;

    /**
     * @api
     *
     * @param string $objectID Vault object ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function processObject(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): GraphragProcessObjectResponse;
}
