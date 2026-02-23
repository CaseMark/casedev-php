<?php

declare(strict_types=1);

namespace Router\Privilege\V1\V1DetectResponse;

/**
 * Recommended action for discovery.
 */
enum Recommendation: string
{
    case WITHHOLD = 'withhold';

    case REDACT = 'redact';

    case PRODUCE = 'produce';

    case REVIEW = 'review';
}
