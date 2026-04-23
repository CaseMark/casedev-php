<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints\EndpointListParams;

/**
 * Filter by endpoint status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case AUTO_DISABLED = 'auto_disabled';
}
