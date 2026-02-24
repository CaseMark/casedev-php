<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunCancelResponse;

enum Status: string
{
    case CANCELLED = 'cancelled';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
