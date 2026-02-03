<?php

declare(strict_types=1);

namespace Casedev\Privilege\V1\V1DetectParams;

enum Category: string
{
    case ATTORNEY_CLIENT = 'attorney_client';

    case WORK_PRODUCT = 'work_product';

    case COMMON_INTEREST = 'common_interest';

    case LITIGATION_HOLD = 'litigation_hold';
}
