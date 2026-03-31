<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Execute\ExecuteNewResponse;

enum Provider: string
{
    case DAYTONA = 'daytona';

    case VERCEL = 'vercel';
}
