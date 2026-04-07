<?php

declare(strict_types=1);

namespace CaseDev\Services\Usage;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Usage\V1Contract;
use CaseDev\Services\Usage\V1\SubscriptionsService;
use CaseDev\Usage\V1\V1RetrieveParams\Granularity;

/**
 * Usage reporting and webhook subscriptions.
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
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }

    /**
     * @api
     *
     * Returns customer-facing usage metrics and costs for the requested period. Supports summary totals and daily buckets for timestamped usage sources. Vault storage is intentionally omitted from totals because it is not yet periodized for arbitrary windows.
     *
     * @param Granularity|value-of<Granularity> $granularity whether to return period totals only or include daily buckets
     * @param \DateTimeInterface $periodEnd Period end date. Defaults to now.
     * @param \DateTimeInterface $periodStart Period start date. Defaults to the start of the current calendar month.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        Granularity|string $granularity = 'summary',
        ?\DateTimeInterface $periodEnd = null,
        ?\DateTimeInterface $periodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'granularity' => $granularity,
                'periodEnd' => $periodEnd,
                'periodStart' => $periodStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
