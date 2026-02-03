<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\Instances\InstanceDeleteResponse;
use Casedev\Compute\V1\Instances\InstanceGetResponse;
use Casedev\Compute\V1\Instances\InstanceListResponse;
use Casedev\Compute\V1\Instances\InstanceNewResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\InstancesContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class InstancesService implements InstancesContract
{
    /**
     * @api
     */
    public InstancesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InstancesRawService($client);
    }

    /**
     * @api
     *
     * Launches a new GPU compute instance with automatic SSH key generation. Supports mounting Case.dev Vaults as filesystems and configurable auto-shutdown. Instance boots in ~2-5 minutes. Perfect for batch OCR processing, AI model training, and intensive document analysis workloads.
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
    ): InstanceNewResponse {
        $params = Util::removeNulls(
            [
                'instanceType' => $instanceType,
                'name' => $name,
                'region' => $region,
                'autoShutdownMinutes' => $autoShutdownMinutes,
                'vaultIDs' => $vaultIDs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves detailed information about a GPU instance including SSH connection details, vault mount scripts, real-time cost tracking, and current status. SSH private key included for secure access.
     *
     * @param string $id Instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): InstanceGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves all GPU compute instances for your organization with real-time status updates from Lambda Labs. Includes pricing, runtime metrics, and auto-shutdown configuration. Perfect for monitoring AI workloads, document processing jobs, and cost tracking.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): InstanceListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Terminates a running GPU instance, calculates final cost, and cleans up SSH keys. This action is permanent and cannot be undone. All data on the instance will be lost.
     *
     * @param string $id Instance ID to terminate
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): InstanceDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
