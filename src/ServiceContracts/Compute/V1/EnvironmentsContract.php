<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute\V1;

use CaseDev\Compute\V1\Environments\EnvironmentDeleteResponse;
use CaseDev\Compute\V1\Environments\EnvironmentGetResponse;
use CaseDev\Compute\V1\Environments\EnvironmentListResponse;
use CaseDev\Compute\V1\Environments\EnvironmentNewResponse;
use CaseDev\Compute\V1\Environments\EnvironmentSetDefaultResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
    ): EnvironmentGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): EnvironmentListResponse;

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
    ): EnvironmentSetDefaultResponse;
}
