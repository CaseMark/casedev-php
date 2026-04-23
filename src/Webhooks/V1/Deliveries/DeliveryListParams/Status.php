<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Deliveries\DeliveryListParams;

enum Status: string
{
    case PENDING = 'pending';

    case DELIVERED = 'delivered';

    case FAILED = 'failed';
}
