<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Parties\PartyUpdateParams;

enum Role: string
{
    case CLIENT = 'client';

    case VENDOR = 'vendor';

    case COUNSEL = 'counsel';

    case EXPERT = 'expert';

    case LIEN_HOLDER = 'lien_holder';

    case FUNDER = 'funder';

    case OPPOSING_PARTY = 'opposing_party';

    case OTHER = 'other';
}
