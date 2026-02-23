<?php

declare(strict_types=1);

namespace Router\Services\Compute;

use Router\Client;
use Router\Compute\V1\V1GetUsageResponse;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Compute\V1Contract;
use Router\Services\Compute\V1\EnvironmentsService;
use Router\Services\Compute\V1\InstancesService;
use Router\Services\Compute\V1\InstanceTypesService;
use Router\Services\Compute\V1\SecretsService;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
    public EnvironmentsService $environments;

    /**
     * @api
     */
    public InstanceTypesService $instanceTypes;

    /**
     * @api
     */
    public InstancesService $instances;

    /**
     * @api
     */
    public SecretsService $secrets;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->environments = new EnvironmentsService($client);
        $this->instanceTypes = new InstanceTypesService($client);
        $this->instances = new InstancesService($client);
        $this->secrets = new SecretsService($client);
    }

    /**
     * @api
     *
     * Returns current pricing for GPU instances. Prices are fetched in real-time and include a 20% platform fee. For detailed instance types and availability, use GET /compute/v1/instance-types.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPricing(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getPricing(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
     *
     * @param int $month Month to filter usage data (1-12, defaults to current month)
     * @param int $year Year to filter usage data (defaults to current year)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getUsage(
        ?int $month = null,
        ?int $year = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1GetUsageResponse {
        $params = Util::removeNulls(['month' => $month, 'year' => $year]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getUsage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
