<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Environments\EnvironmentDeleteResponse;
use Casedev\Compute\V1\Environments\EnvironmentNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface EnvironmentsContract
{
    /**
     * @api
     *
     * @param string $name Environment name (alphanumeric, hyphens, and underscores only)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): EnvironmentNewResponse;

    /**
     * @api
     *
     * @param string $name The name of the compute environment to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $name Name of the compute environment to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): EnvironmentDeleteResponse;

    /**
     * @api
     *
     * @param string $name Name of the compute environment to set as default
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function setDefault(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
