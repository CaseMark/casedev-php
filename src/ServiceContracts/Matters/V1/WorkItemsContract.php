<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Priority;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Type;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams\Decision;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Status;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface WorkItemsContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $workItemID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listExecutions(
        string $workItemID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
