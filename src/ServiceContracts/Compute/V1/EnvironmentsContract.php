<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface EnvironmentsContract
{
    /**
     * @api
     *
     * @param string $name Environment name (alphanumeric, hyphens, and underscores only)
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?RequestOptions $requestOptions = null
    ): EnvironmentNewResponse;

    /**
     * @api
     *
     * @param string $name The name of the compute environment to retrieve
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
     * @param string $name Name of the compute environment to delete
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
     * @param string $name Name of the compute environment to set as default
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
