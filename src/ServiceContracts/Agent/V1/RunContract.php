<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface RunContract
{
    /**
     * @api
     *
     * @param string $agentID ID of the agent to run
     * @param string $prompt Task prompt for the agent
     * @param string|null $guidance Additional guidance for this run
     * @param string|null $model Override the agent default model for this run
     * @param list<string>|null $objectIDs Scope this run to specific vault object IDs. The agent will only be able to access these objects during execution.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $agentID,
        string $prompt,
        ?string $guidance = null,
        ?string $model = null,
        ?array $objectIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): RunNewResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunCancelResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function exec(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunExecResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetDetailsResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetStatusResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param string $callbackURL HTTPS URL to receive completion callback
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function watch(
        string $id,
        string $callbackURL,
        RequestOptions|array|null $requestOptions = null,
    ): RunWatchResponse;
}
