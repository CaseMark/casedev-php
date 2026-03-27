<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2;

use CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox;
use CaseDev\Agent\V2\Execute\ExecuteNewResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type SandboxShape from \CaseDev\Agent\V2\Execute\ExecuteCreateParams\Sandbox
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ExecuteContract
{
    /**
     * @api
     *
     * @param list<string>|null $disabledTools
     * @param list<string>|null $enabledTools
     * @param list<string>|null $objectIDs
     * @param Sandbox|SandboxShape|null $sandbox
     * @param list<string>|null $vaultIDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $prompt,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?string $guidance = null,
        ?string $instructions = null,
        ?string $model = null,
        ?array $objectIDs = null,
        Sandbox|array|null $sandbox = null,
        ?array $vaultIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): ExecuteNewResponse;
}
