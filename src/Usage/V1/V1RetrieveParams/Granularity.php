<?php

declare(strict_types=1);

namespace CaseDev\Usage\V1\V1RetrieveParams;

/**
 * Whether to return period totals only or include daily buckets.
 */
enum Granularity: string
{
    case SUMMARY = 'summary';

    case DAILY = 'daily';
}
