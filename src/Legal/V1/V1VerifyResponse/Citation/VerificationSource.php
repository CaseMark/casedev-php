<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1VerifyResponse\Citation;

/**
 * Source of verification result (heuristic for fallback matches).
 */
enum VerificationSource: string
{
    case COURTLISTENER = 'courtlistener';

    case HEURISTIC = 'heuristic';
}
