<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Priority;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams\Type;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams\Decision;
use CaseDev\Matters\V1\WorkItems\WorkItemListExecutionsParams;
use CaseDev\Matters\V1\WorkItems\WorkItemListParams;
use CaseDev\Matters\V1\WorkItems\WorkItemRetrieveParams;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams\Status;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\WorkItemsRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class WorkItemsRawService implements WorkItemsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an active work item on a matter.
     *
     * @param array{
     *   title: string,
     *   assigneeID?: string,
     *   description?: string,
     *   dueAt?: \DateTimeInterface,
     *   exitCriteria?: list<string>,
     *   instructions?: string,
     *   metadata?: array<string,mixed>,
     *   priority?: Priority|value-of<Priority>,
     *   type?: value-of<Type>,
     * }|WorkItemCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|WorkItemCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/work-items', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a single work item for a matter.
     *
     * @param array{id: string}|WorkItemRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $workItemID,
        array|WorkItemRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/work-items/%2$s', $id, $workItemID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update a matter work item.
     *
     * @param string $workItemID Path param
     * @param array{
     *   id: string,
     *   assigneeID?: string|null,
     *   completedAt?: \DateTimeInterface|null,
     *   description?: string,
     *   dueAt?: \DateTimeInterface|null,
     *   exitCriteria?: list<string>,
     *   instructions?: string|null,
     *   metadata?: array<string,mixed>,
     *   priority?: WorkItemUpdateParams\Priority|value-of<WorkItemUpdateParams\Priority>,
     *   startedAt?: \DateTimeInterface|null,
     *   status?: value-of<Status>,
     *   title?: string,
     *   type?: value-of<WorkItemUpdateParams\Type>,
     * }|WorkItemUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $workItemID,
        array|WorkItemUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['matters/v1/%1$s/work-items/%2$s', $id, $workItemID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List active work items for a matter.
     *
     * @param array{assigneeID?: string, status?: string}|WorkItemListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|WorkItemListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/work-items', $id],
            query: Util::array_transform_keys(
                $parsed,
                ['assigneeID' => 'assignee_id']
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Allow a human to act as the orchestrator for a work item.
     *
     * @param string $workItemID Path param
     * @param array{
     *   id: string,
     *   decision: Decision|value-of<Decision>,
     *   agentTypeID?: string|null,
     *   metadata?: array<string,mixed>,
     *   reason?: string|null,
     * }|WorkItemDecideParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function decide(
        string $workItemID,
        array|WorkItemDecideParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemDecideParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/work-items/%2$s/decision', $id, $workItemID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List execution attempts for a work item, including agent and run linkage.
     *
     * @param array{id: string}|WorkItemListExecutionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listExecutions(
        string $workItemID,
        array|WorkItemListExecutionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkItemListExecutionsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/work-items/%2$s/executions', $id, $workItemID],
            options: $options,
            convert: null,
        );
    }
}
