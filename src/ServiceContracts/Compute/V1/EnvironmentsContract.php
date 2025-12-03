<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Environments\EnvironmentCreateParams;
use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface EnvironmentsContract
{
    /**
     * @api
     *
     * @param array<mixed>|EnvironmentCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|EnvironmentCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): EnvironmentNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        ?RequestOptions $requestOptions = null
    ): EnvironmentDeleteResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
