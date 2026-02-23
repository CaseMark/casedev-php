<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Compute\V1;

use Router\Compute\V1\Instances\InstanceDeleteResponse;
use Router\Compute\V1\Instances\InstanceGetResponse;
use Router\Compute\V1\Instances\InstanceListResponse;
use Router\Compute\V1\Instances\InstanceNewResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface InstancesContract
{
    /**
     * @api
     *
     * @param string $instanceType GPU type (e.g., 'gpu_1x_h100_sxm5')
     * @param string $name Instance name
     * @param string $region Region (e.g., 'us-west-1')
     * @param int|null $autoShutdownMinutes Auto-shutdown timer (null = never)
     * @param list<string> $vaultIDs Vault IDs to mount
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $instanceType,
        string $name,
        string $region,
        ?int $autoShutdownMinutes = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): InstanceNewResponse;

    /**
     * @api
     *
     * @param string $id Instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): InstanceGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): InstanceListResponse;

    /**
     * @api
     *
     * @param string $id Instance ID to terminate
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): InstanceDeleteResponse;
}
