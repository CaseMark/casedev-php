<?php

declare(strict_types=1);

namespace CaseDev\Services\Applications\V1;

use CaseDev\Applications\V1\Workflows\WorkflowGetStatusParams;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Applications\V1\WorkflowsRawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
