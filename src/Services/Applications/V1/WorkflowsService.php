<?php

declare(strict_types=1);

namespace Router\Services\Applications\V1;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Applications\V1\WorkflowsContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class WorkflowsService implements WorkflowsContract
{
    /**
     * @api
     */
    public WorkflowsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkflowsRawService($client);
    }

    /**
     * @api
     *
     * Get current deployment workflow status and accumulated events
     *
     * @param string $id Workflow run ID
     * @param string $projectID Project ID (for authorization)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['projectID' => $projectID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatus($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
