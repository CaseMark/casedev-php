<?php

declare(strict_types=1);

namespace Casedev\Services\Applications\V1;

use Casedev\Applications\V1\Workflows\WorkflowGetStatusParams;
use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Applications\V1\WorkflowsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class WorkflowsRawService implements WorkflowsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get current deployment workflow status and accumulated events
     *
     * @param string $id Workflow run ID
     * @param array{projectID: string}|WorkflowGetStatusParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        array|WorkflowGetStatusParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkflowGetStatusParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['applications/v1/workflows/%1$s/status', $id],
            query: Util::array_transform_keys($parsed, ['projectID' => 'projectId']),
            options: $options,
            convert: null,
        );
    }
}
