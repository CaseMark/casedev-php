<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams;

enum Role: string
{
    case CLIENT = 'client';

    case PROSPECT = 'prospect';

    case OPPOSING_PARTY = 'opposing_party';

    case OPPOSING_COUNSEL = 'opposing_counsel';

    case CO_COUNSEL = 'co_counsel';

    case JUDGE = 'judge';

    case EXPERT = 'expert';

    case WITNESS = 'witness';

    case VENDOR = 'vendor';

    case INSURER = 'insurer';

    case OTHER = 'other';
}
