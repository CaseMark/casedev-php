<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute;

use Casedev\Compute\V1\V1DeployParams\Config\GPUType;
use Casedev\Compute\V1\V1DeployParams\Runtime;
use Casedev\Compute\V1\V1DeployParams\Type;
use Casedev\Compute\V1\V1DeployResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
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
    ): V1DeployResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function getPricing(?RequestOptions $requestOptions = null): mixed;

    /**
     * @api
     *
     * @param int $month Month to filter usage data (1-12, defaults to current month)
     * @param int $year Year to filter usage data (defaults to current year)
     *
     * @throws APIException
     */
    public function getUsage(
        ?int $month = null,
        ?int $year = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
