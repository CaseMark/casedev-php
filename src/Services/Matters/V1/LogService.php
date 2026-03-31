<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\Log\LogExportParams\Format;
use CaseDev\Matters\V1\Log\LogExportResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\LogContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogListParams\Scope
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogExportParams\Scope as ScopeShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class LogService implements LogContract
{
    /**
     * @api
     */
    public LogRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LogRawService($client);
    }

    /**
     * @api
     *
     * Append a manual operational note or event to a matter log.
     *
     * @param array<string,mixed> $details
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $summary,
        ?array $details = null,
        ?string $eventType = null,
        ?string $workItemID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'summary' => $summary,
                'details' => $details,
                'eventType' => $eventType,
                'workItemID' => $workItemID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the operational history for a matter.
     *
     * @param string $actorID Filter by actor ID
     * @param string $actorType Filter by actor type
     * @param \DateTimeInterface $endTime End of time range (ISO 8601)
     * @param string $eventType Filter by exact event type
     * @param int $limit Maximum number of log entries to return (max 200)
     * @param int $offset Number of log entries to skip for pagination
     * @param ScopeShape $scope Filter by scope: matter, work_item, execution, sharing, all
     * @param \DateTimeInterface $startTime Start of time range (ISO 8601)
     * @param string $workItemID Filter by work item ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?string $actorID = null,
        ?string $actorType = null,
        ?\DateTimeInterface $endTime = null,
        ?string $eventType = null,
        int $limit = 50,
        int $offset = 0,
        string|array|null $scope = null,
        ?\DateTimeInterface $startTime = null,
        ?string $workItemID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'actorID' => $actorID,
                'actorType' => $actorType,
                'endTime' => $endTime,
                'eventType' => $eventType,
                'limit' => $limit,
                'offset' => $offset,
                'scope' => $scope,
                'startTime' => $startTime,
                'workItemID' => $workItemID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Bulk export matter log entries for audits, visibility, and eval pipelines. Supports json, csv, tsv, and jsonl. Limited to 10,000 entries per request.
     *
     * @param string $actorID Filter by actor ID
     * @param string $actorType Filter by actor type
     * @param \DateTimeInterface $endTime End of time range (ISO 8601)
     * @param string $eventType Filter by exact event type
     * @param Format|value-of<Format> $format Export format. Defaults to jsonl.
     * @param ScopeShape1 $scope Filter by scope: matter, work_item, execution, sharing, all
     * @param \DateTimeInterface $startTime Start of time range (ISO 8601)
     * @param string $workItemID Filter by work item ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function export(
        string $id,
        ?string $actorID = null,
        ?string $actorType = null,
        ?\DateTimeInterface $endTime = null,
        ?string $eventType = null,
        Format|string|null $format = null,
        string|array|null $scope = null,
        ?\DateTimeInterface $startTime = null,
        ?string $workItemID = null,
        RequestOptions|array|null $requestOptions = null,
    ): LogExportResponse {
        $params = Util::removeNulls(
            [
                'actorID' => $actorID,
                'actorType' => $actorType,
                'endTime' => $endTime,
                'eventType' => $eventType,
                'format' => $format,
                'scope' => $scope,
                'startTime' => $startTime,
                'workItemID' => $workItemID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->export($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
