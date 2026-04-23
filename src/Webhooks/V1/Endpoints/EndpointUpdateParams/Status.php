<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams;

enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';
}
