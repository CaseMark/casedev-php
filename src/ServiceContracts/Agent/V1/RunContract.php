<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunListParams\Status;
use CaseDev\Agent\V1\Run\RunListResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchResponse;
use CaseDev\Core\Contracts\BaseStream;
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
     * @param string|null $callbackURL HTTPS callback URL to receive a notification when the run completes. Registered atomically with the run — eliminates the race condition of calling /watch after /exec. Additional watchers can still be added via POST /run/:id/watch.
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
        ?string $callbackURL = null,
        ?string $guidance = null,
        ?string $model = null,
        ?array $objectIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): RunNewResponse;

    /**
     * @api
     *
     * @param string $agentID Filter by agent ID
     * @param string $cursor Pagination cursor (run ID from previous page). Returns runs created before this run.
     * @param int $limit Maximum number of runs to return (default 50, max 250)
     * @param Status|value-of<Status> $status Filter by run status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $agentID = null,
        ?string $cursor = null,
        int $limit = 50,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): RunListResponse;

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
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function eventsStream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

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
