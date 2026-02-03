<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts\AccountCreateParams;

/**
 * Account type.
 */
enum Type: string
{
    case TRUST = 'trust';

    case OPERATING = 'operating';

    case ESCROW = 'escrow';

    case RESERVE = 'reserve';

    case CLIENT = 'client';

    case SUB = 'sub';
}
