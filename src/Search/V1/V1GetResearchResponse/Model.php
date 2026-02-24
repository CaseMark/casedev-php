<?php

declare(strict_types=1);

namespace CaseDev\Search\V1\V1GetResearchResponse;

/**
 * Research model used.
 */
enum Model: string
{
    case FAST = 'fast';

    case NORMAL = 'normal';

    case PRO = 'pro';
}
