<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Instances\InstanceListResponse\Instance;

enum Status: string
{
    case BOOTING = 'booting';

    case RUNNING = 'running';

    case STOPPING = 'stopping';

    case STOPPED = 'stopped';

    case TERMINATED = 'terminated';

    case FAILED = 'failed';
}
