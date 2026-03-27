<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2;

use CaseDev\Agent\V2\Run\RunExecResponse;
use CaseDev\Agent\V2\Run\RunGetStatusResponse;
use CaseDev\Agent\V2\Run\RunNewResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\RunContract;

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
     * Creates a v2 run in queued state. Call POST /agent/v2/run/:id/exec to start execution on the Daytona runtime.
     *
     * @param list<string>|null $objectIDs
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
     * Starts execution of a queued v2 run. The agent runs in a durable workflow on a Daytona runtime.
     *
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
     * Full audit trail for a v2 run, with provider-neutral runtime metadata.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getDetails($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lightweight status poll for a v2 run including neutral runtime metadata.
     *
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
}
