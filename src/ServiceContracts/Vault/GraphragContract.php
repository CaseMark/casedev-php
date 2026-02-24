<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Graphrag\GraphragGetStatsResponse;
use CaseDev\Vault\Graphrag\GraphragInitResponse;
use CaseDev\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
