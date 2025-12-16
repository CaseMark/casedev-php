<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1ExecuteResponse;

enum Mode: string
{
    case FIRE_AND_FORGET = 'fire-and-forget';

    case CALLBACK = 'callback';

    case SYNC = 'sync';
}
