<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Payouts\PayoutCreateParams;

enum DestinationType: string
{
    case BANK_ACCOUNT = 'bank_account';

    case CARD = 'card';
}
