<?php

declare(strict_types=1);

namespace CaseDev\Services\Database;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Database\V1\V1GetUsageResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Database\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
     * Returns detailed database usage statistics and billing information for the current billing period. Includes compute hours, storage, data transfer, and branch counts with associated costs broken down by project.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetUsageResponse>
     *
     * @throws APIException
     */
    public function getUsage(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'database/v1/usage',
            options: $requestOptions,
            convert: V1GetUsageResponse::class,
        );
    }
}
