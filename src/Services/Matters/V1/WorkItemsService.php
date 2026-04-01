<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Priority;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Type;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams\Decision;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Status;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\WorkItemsContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class WorkItemsService implements WorkItemsContract
{
    /**
     * @api
     */
    public WorkItemsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkItemsRawService($client);
    }

    /**
     * @api
     *
     * Create an active work item on a matter.
     *
     * @param list<string> $exitCriteria
     * @param array<string,mixed> $metadata
     * @param Priority|value-of<Priority> $priority
     * @param Type|value-of<Type> $type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $title,
        ?string $assigneeID = null,
        ?string $description = null,
        ?\DateTimeInterface $dueAt = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $metadata = null,
        Priority|string|null $priority = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'title' => $title,
                'assigneeID' => $assigneeID,
                'description' => $description,
                'dueAt' => $dueAt,
                'exitCriteria' => $exitCriteria,
                'instructions' => $instructions,
                'metadata' => $metadata,
                'priority' => $priority,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a single work item for a matter.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $workItemID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($workItemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a matter work item.
     *
     * @param string $workItemID Path param
     * @param string $id Path param
     * @param string|null $assigneeID Body param
     * @param \DateTimeInterface|null $completedAt Body param
     * @param string $description Body param
     * @param \DateTimeInterface|null $dueAt Body param
     * @param list<string> $exitCriteria Body param
     * @param string|null $instructions Body param
     * @param array<string,mixed> $metadata Body param
     * @param \CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Priority|value-of<\CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Priority> $priority Body param
     * @param \DateTimeInterface|null $startedAt Body param
     * @param Status|value-of<Status> $status Body param
     * @param string $title Body param
     * @param \CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Type|value-of<\CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Type> $type Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $workItemID,
        string $id,
        ?string $assigneeID = null,
        ?\DateTimeInterface $completedAt = null,
        ?string $description = null,
        ?\DateTimeInterface $dueAt = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $metadata = null,
        \CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Priority|string|null $priority = null,
        ?\DateTimeInterface $startedAt = null,
        Status|string|null $status = null,
        ?string $title = null,
        \CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'assigneeID' => $assigneeID,
                'completedAt' => $completedAt,
                'description' => $description,
                'dueAt' => $dueAt,
                'exitCriteria' => $exitCriteria,
                'instructions' => $instructions,
                'metadata' => $metadata,
                'priority' => $priority,
                'startedAt' => $startedAt,
                'status' => $status,
                'title' => $title,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($workItemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List active work items for a matter.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?string $assigneeID = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['assigneeID' => $assigneeID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Approve, revise, block, or reassign a work item. Used by humans or agents to move work items through their lifecycle.
     *
     * @param string $workItemID Path param
     * @param string $id Path param
     * @param Decision|value-of<Decision> $decision Body param
     * @param string|null $agentTypeID Body param
     * @param array<string,mixed> $metadata Body param
     * @param string|null $reason Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function decide(
        string $workItemID,
        string $id,
        Decision|string $decision,
        ?string $agentTypeID = null,
        ?array $metadata = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'decision' => $decision,
                'agentTypeID' => $agentTypeID,
                'metadata' => $metadata,
                'reason' => $reason,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->decide($workItemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List execution attempts for a work item, including agent and run linkage.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listExecutions(
        string $workItemID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listExecutions($workItemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
