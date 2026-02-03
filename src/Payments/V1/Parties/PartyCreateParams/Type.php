<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Parties\PartyCreateParams;

enum Type: string
{
    case INDIVIDUAL = 'individual';

    case ORGANIZATION = 'organization';
}
