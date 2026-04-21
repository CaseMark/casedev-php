<?php

declare(strict_types=1);

namespace CaseDev\Services\Compute;

use CaseDev\Client;
use CaseDev\Compute\V1\V1GetUsageResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Compute\V1Contract;
use CaseDev\Services\Compute\V1\EnvironmentsService;
use CaseDev\Services\Compute\V1\SecretsService;

/**
 * Serverless GPU and CPU infrastructure.
 *
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
    public EnvironmentsService $environments;

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
        $this->secrets = new SecretsService($client);
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
