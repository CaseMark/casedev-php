<?php

declare(strict_types=1);

namespace Casedev\Services\Compute;

use Casedev\Client;
use Casedev\Compute\V1\V1GetUsageParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns current pricing for GPU instances. Prices are fetched in real-time and include a 20% platform fee. For detailed instance types and availability, use GET /compute/v1/instance-types.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getPricing(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/pricing',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns detailed compute usage statistics and billing information for your organization. Includes GPU and CPU hours, total runs, costs, and breakdowns by environment. Use optional query parameters to filter by specific year and month.
     *
     * @param array{month?: int, year?: int}|V1GetUsageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getUsage(
        array|V1GetUsageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1GetUsageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/usage',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
