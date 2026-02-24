<?php

declare(strict_types=1);

namespace CaseDev\Search\V1\V1ResearchParams;

/**
 * Research quality level - fast (quick), normal (balanced), pro (comprehensive).
 */
enum Model: string
{
    case FAST = 'fast';

    case NORMAL = 'normal';

    case PRO = 'pro';
}
