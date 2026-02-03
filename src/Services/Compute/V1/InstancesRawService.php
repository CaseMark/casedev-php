<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Instances\InstanceCreateParams;
use Casedev\Compute\V1\Instances\InstanceDeleteResponse;
use Casedev\Compute\V1\Instances\InstanceGetResponse;
use Casedev\Compute\V1\Instances\InstanceListResponse;
use Casedev\Compute\V1\Instances\InstanceNewResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\InstancesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class InstancesRawService implements InstancesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Launches a new GPU compute instance with automatic SSH key generation. Supports mounting Case.dev Vaults as filesystems and configurable auto-shutdown. Instance boots in ~2-5 minutes. Perfect for batch OCR processing, AI model training, and intensive document analysis workloads.
     *
     * @param array{
     *   instanceType: string,
     *   name: string,
     *   region: string,
     *   autoShutdownMinutes?: int|null,
     *   vaultIDs?: list<string>,
     * }|InstanceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InstanceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InstanceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'compute/v1/instances',
            body: (object) $parsed,
            options: $options,
            convert: InstanceNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves detailed information about a GPU instance including SSH connection details, vault mount scripts, real-time cost tracking, and current status. SSH private key included for secure access.
     *
     * @param string $id Instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['compute/v1/instances/%1$s', $id],
            options: $requestOptions,
            convert: InstanceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves all GPU compute instances for your organization with real-time status updates from Lambda Labs. Includes pricing, runtime metrics, and auto-shutdown configuration. Perfect for monitoring AI workloads, document processing jobs, and cost tracking.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/instances',
            options: $requestOptions,
            convert: InstanceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Terminates a running GPU instance, calculates final cost, and cleans up SSH keys. This action is permanent and cannot be undone. All data on the instance will be lost.
     *
     * @param string $id Instance ID to terminate
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['compute/v1/instances/%1$s', $id],
            options: $requestOptions,
            convert: InstanceDeleteResponse::class,
        );
    }
}
