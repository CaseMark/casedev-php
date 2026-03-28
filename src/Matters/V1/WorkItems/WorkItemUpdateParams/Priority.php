<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams;

enum Priority: string
{
    case LOW = 'low';

    case NORMAL = 'normal';

    case HIGH = 'high';

    case URGENT = 'urgent';
}
