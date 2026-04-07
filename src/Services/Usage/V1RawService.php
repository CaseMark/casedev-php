<?php

declare(strict_types=1);

namespace CaseDev\Services\Usage;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Usage\V1RawContract;
use CaseDev\Usage\V1\V1RetrieveParams;
use CaseDev\Usage\V1\V1RetrieveParams\Granularity;

/**
 * Usage reporting and webhook subscriptions.
 *
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
     * Returns customer-facing usage metrics and costs for the requested period. Supports summary totals and daily buckets for timestamped usage sources. Vault storage is intentionally omitted from totals because it is not yet periodized for arbitrary windows.
     *
     * @param array{
     *   granularity?: Granularity|value-of<Granularity>,
     *   periodEnd?: \DateTimeInterface,
     *   periodStart?: \DateTimeInterface,
     * }|V1RetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        array|V1RetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1RetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'usage/v1',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
