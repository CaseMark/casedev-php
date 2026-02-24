<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1VerifyResponse\Citation;

enum Status: string
{
    case VERIFIED = 'verified';

    case NOT_FOUND = 'not_found';

    case MULTIPLE_MATCHES = 'multiple_matches';
}
