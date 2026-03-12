<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunListParams\Status;
use CaseDev\Agent\V1\Run\RunListResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V1\RunContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class RunService implements RunContract
{
    /**
     * @api
     */
    public RunRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RunRawService($client);
    }

    /**
     * @api
     *
     * Creates a run in queued state. Call POST /agent/v1/run/:id/exec to start execution.
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
    ): RunNewResponse {
        $params = Util::removeNulls(
            [
                'agentID' => $agentID,
                'prompt' => $prompt,
                'callbackURL' => $callbackURL,
                'guidance' => $guidance,
                'model' => $model,
                'objectIDs' => $objectIDs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists agent runs for the authenticated organization. Supports filtering by agent, status, and cursor-based pagination.
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
    ): RunListResponse {
        $params = Util::removeNulls(
            [
                'agentID' => $agentID,
                'cursor' => $cursor,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a running or queued run. Idempotent — cancelling a finished run returns its current status.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunCancelResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($id, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): BaseStream {
        $params = Util::removeNulls(['lastEventID' => $lastEventID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->eventsStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Starts execution of a queued run. The agent runs in a durable workflow — poll /run/:id/status for progress.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function exec(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunExecResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->exec($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Full audit trail for a run including output, steps (tool calls, text), and token usage.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetDetailsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getDetails($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lightweight status poll for a run. Use /run/:id/details for the full audit trail.
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetStatusResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatus($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Register a callback URL to receive notifications when the run completes. URL must use https and must not point to a private network.
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
    ): RunWatchResponse {
        $params = Util::removeNulls(['callbackURL' => $callbackURL]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->watch($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
