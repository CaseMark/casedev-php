<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

/**
 * Current runtime state, when available.
 */
enum RuntimeState: string
{
    case RUNNING = 'running';

    case STOPPED = 'stopped';

    case ARCHIVED = 'archived';

    case ENDED = 'ended';

    case ERROR = 'error';
}
