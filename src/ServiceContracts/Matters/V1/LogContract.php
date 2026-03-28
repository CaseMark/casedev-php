<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Log\LogExportParams\Format;
use CaseDev\Matters\V1\Log\LogExportResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogListParams\Scope
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogExportParams\Scope as ScopeShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface LogContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): LogExportResponse;
}
