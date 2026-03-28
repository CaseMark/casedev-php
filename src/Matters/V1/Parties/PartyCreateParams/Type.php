<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Parties\PartyCreateParams;

enum Type: string
{
    case PERSON = 'person';

    case ORGANIZATION = 'organization';
}
