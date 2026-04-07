<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Usage;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Usage\V1\V1RetrieveParams\Granularity;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
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
    ): mixed;
}
