<?php

declare(strict_types=1);

namespace CaseDev\Services\Database;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Database\V1\V1GetUsageResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Database\V1Contract;
use CaseDev\Services\Database\V1\ProjectsService;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public ProjectsService $projects;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->projects = new ProjectsService($client);
    }

    /**
     * @api
     *
     * Returns detailed database usage statistics and billing information for the current billing period. Includes compute hours, storage, data transfer, and branch counts with associated costs broken down by project.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getUsage(
        RequestOptions|array|null $requestOptions = null
    ): V1GetUsageResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getUsage(requestOptions: $requestOptions);

        return $response->parse();
    }
}
