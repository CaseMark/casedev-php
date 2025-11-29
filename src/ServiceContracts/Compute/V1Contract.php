<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute;

use Casedev\Compute\V1\V1DeployParams;
use Casedev\Compute\V1\V1DeployResponse;
use Casedev\Compute\V1\V1GetUsageParams;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param array<mixed>|V1DeployParams $params
     *
     * @throws APIException
     */
    public function deploy(
        array|V1DeployParams $params,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function getPricing(
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|V1GetUsageParams $params
     *
     * @throws APIException
     */
    public function getUsage(
        array|V1GetUsageParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
