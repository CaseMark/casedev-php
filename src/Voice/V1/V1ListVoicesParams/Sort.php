<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\V1ListVoicesParams;

/**
 * Field to sort by.
 */
enum Sort: string
{
    case NAME = 'name';

    case CREATED_AT = 'created_at';

    case UPDATED_AT = 'updated_at';
}
