<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory\MemoryCreateParams;

enum Type: string
{
    case FACT = 'fact';

    case PARTY = 'party';

    case ISSUE = 'issue';

    case DEADLINE = 'deadline';

    case DISCOVERY = 'discovery';

    case CORRECTION = 'correction';

    case PREFERENCE = 'preference';
}
