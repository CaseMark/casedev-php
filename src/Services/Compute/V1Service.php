<?php

declare(strict_types=1);

namespace Casedev\Services\Compute;

use Casedev\Client;
use Casedev\Compute\V1\V1DeployParams\Config\GPUType;
use Casedev\Compute\V1\V1DeployParams\Runtime;
use Casedev\Compute\V1\V1DeployParams\Type;
use Casedev\Compute\V1\V1DeployResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1Contract;
use Casedev\Services\Compute\V1\EnvironmentsService;
use Casedev\Services\Compute\V1\FunctionsService;
use Casedev\Services\Compute\V1\InvokeService;
use Casedev\Services\Compute\V1\RunsService;
use Casedev\Services\Compute\V1\SecretsService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public EnvironmentsService $environments;

    /**
     * @api
     */
    public FunctionsService $functions;

    /**
     * @api
     */
    public InvokeService $invoke;

    /**
     * @api
     */
    public RunsService $runs;

    /**
     * @api
     */
    public SecretsService $secrets;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->environments = new EnvironmentsService($client);
        $this->functions = new FunctionsService($client);
        $this->invoke = new InvokeService($client);
        $this->runs = new RunsService($client);
        $this->secrets = new SecretsService($client);
    }

    /**
     * @api
     *
     * Deploy code to Case.dev's serverless compute infrastructure powered by Modal. Supports Python, Dockerfile, and container image runtimes with GPU acceleration for AI/ML workloads. Code is deployed as tasks (batch jobs) or services (web endpoints) with automatic scaling.
     *
     * @param string $entrypointName Function/app name (used for domain: hello → hello.org.case.systems)
     * @param 'task'|'service'|Type $type Deployment type: task for batch jobs, service for web endpoints
     * @param string $code Python code (required for python runtime)
     * @param array{
     *   addPython?: string,
     *   allowNetwork?: bool,
     *   cmd?: list<string>,
     *   concurrency?: int,
     *   cpuCount?: int,
     *   cronSchedule?: string,
     *   dependencies?: list<string>,
     *   entrypoint?: list<string>,
     *   env?: array<string,string>,
     *   gpuCount?: int,
     *   gpuType?: 'cpu'|'T4'|'L4'|'A10G'|'L40S'|'A100'|'A100-40GB'|'A100-80GB'|'H100'|'H200'|'B200'|GPUType,
     *   isWebService?: bool,
     *   memoryMB?: int,
     *   pipInstall?: list<string>,
     *   port?: int,
     *   pythonVersion?: string,
     *   retries?: int,
     *   secretGroups?: list<string>,
     *   timeoutSeconds?: int,
     *   useUv?: bool,
     *   warmInstances?: int,
     *   workdir?: string,
     * } $config Runtime and resource configuration
     * @param string $dockerfile Dockerfile content (required for dockerfile runtime)
     * @param string $entrypointFile Python entrypoint file name
     * @param string $environment Environment name (uses default if not specified)
     * @param string $image Container image name (required for image runtime, e.g., 'nvidia/cuda:12.8.1-devel-ubuntu22.04')
     * @param 'python'|'dockerfile'|'image'|Runtime $runtime Runtime environment
     *
     * @throws APIException
     */
    public function deploy(
        string $entrypointName,
        string|Type $type,
        ?string $code = null,
        ?array $config = null,
        ?string $dockerfile = null,
        string $entrypointFile = 'app.py',
        ?string $environment = null,
        ?string $image = null,
        string|Runtime $runtime = 'python',
        ?RequestOptions $requestOptions = null,
    ): V1DeployResponse {
        $params = [
            'entrypointName' => $entrypointName,
            'type' => $type,
            'code' => $code,
            'config' => $config,
            'dockerfile' => $dockerfile,
            'entrypointFile' => $entrypointFile,
            'environment' => $environment,
            'image' => $image,
            'runtime' => $runtime,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deploy(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns current pricing for GPU and CPU compute resources. This public endpoint provides detailed pricing information for all available compute types, including GPU instances and CPU cores, with billing model details.
     *
     * @throws APIException
     */
    public function getPricing(?RequestOptions $requestOptions = null): mixed
    {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getPricing(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
     *
     * @param int $month Month to filter usage data (1-12, defaults to current month)
     * @param int $year Year to filter usage data (defaults to current year)
     *
     * @throws APIException
     */
    public function getUsage(
        ?int $month = null,
        ?int $year = null,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['month' => $month, 'year' => $year];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getUsage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
