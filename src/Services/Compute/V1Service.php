<?php

declare(strict_types=1);

namespace Casedev\Services\Compute;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1Contract;
use Casedev\Services\Compute\V1\EnvironmentsService;
use Casedev\Services\Compute\V1\FunctionsService;
use Casedev\Services\Compute\V1\InvokeService;
use Casedev\Services\Compute\V1\RunsService;
use Casedev\Services\Compute\V1\SecretsService;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
    public FunctionsService $functions;

    /**
     * @api
     */
    public InvokeService $invoke;

    /**
     * @api
     */
    public RunsService $runs;

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
        $this->functions = new FunctionsService($client);
        $this->invoke = new InvokeService($client);
        $this->runs = new RunsService($client);
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
    ): mixed {
        $params = Util::removeNulls(['month' => $month, 'year' => $year]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getUsage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
