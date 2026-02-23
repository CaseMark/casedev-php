<?php

declare(strict_types=1);

namespace Router\Search\V1\V1GetResearchResponse;

/**
 * Research model used.
 */
enum Model: string
{
    case FAST = 'fast';

    case NORMAL = 'normal';

    case PRO = 'pro';
}
