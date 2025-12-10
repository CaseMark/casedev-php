<?php

declare(strict_types=1);

namespace Casedev\Services\Compute;

use Casedev\Client;
use Casedev\Compute\V1\V1DeployParams;
use Casedev\Compute\V1\V1DeployParams\Config\GPUType;
use Casedev\Compute\V1\V1DeployParams\Runtime;
use Casedev\Compute\V1\V1DeployParams\Type;
use Casedev\Compute\V1\V1DeployResponse;
use Casedev\Compute\V1\V1GetUsageParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Deploy code to Case.dev's serverless compute infrastructure powered by Modal. Supports Python, Dockerfile, and container image runtimes with GPU acceleration for AI/ML workloads. Code is deployed as tasks (batch jobs) or services (web endpoints) with automatic scaling.
     *
     * @param array{
     *   entrypointName: string,
     *   type: 'task'|'service'|Type,
     *   code?: string,
     *   config?: array{
     *     addPython?: string,
     *     allowNetwork?: bool,
     *     cmd?: list<string>,
     *     concurrency?: int,
     *     cpuCount?: int,
     *     cronSchedule?: string,
     *     dependencies?: list<string>,
     *     entrypoint?: list<string>,
     *     env?: array<string,string>,
     *     gpuCount?: int,
     *     gpuType?: 'cpu'|'T4'|'L4'|'A10G'|'L40S'|'A100'|'A100-40GB'|'A100-80GB'|'H100'|'H200'|'B200'|GPUType,
     *     isWebService?: bool,
     *     memoryMB?: int,
     *     pipInstall?: list<string>,
     *     port?: int,
     *     pythonVersion?: string,
     *     retries?: int,
     *     secretGroups?: list<string>,
     *     timeoutSeconds?: int,
     *     useUv?: bool,
     *     warmInstances?: int,
     *     workdir?: string,
     *   },
     *   dockerfile?: string,
     *   entrypointFile?: string,
     *   environment?: string,
     *   image?: string,
     *   runtime?: 'python'|'dockerfile'|'image'|Runtime,
     * }|V1DeployParams $params
     *
     * @return BaseResponse<V1DeployResponse>
     *
     * @throws APIException
     */
    public function deploy(
        array|V1DeployParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1DeployParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'compute/v1/deploy',
            body: (object) $parsed,
            options: $options,
            convert: V1DeployResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns current pricing for GPU and CPU compute resources. This public endpoint provides detailed pricing information for all available compute types, including GPU instances and CPU cores, with billing model details.
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getPricing(
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/pricing',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
     *
     * @param array{month?: int, year?: int}|V1GetUsageParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getUsage(
        array|V1GetUsageParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1GetUsageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/usage',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
