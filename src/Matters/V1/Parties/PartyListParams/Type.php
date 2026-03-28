<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Parties\PartyListParams;

enum Type: string
{
    case PERSON = 'person';

    case ORGANIZATION = 'organization';
}
